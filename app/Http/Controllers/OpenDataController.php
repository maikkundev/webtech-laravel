<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\Yaml\Yaml;

class OpenDataController extends Controller
{
    /**
     * Show the export information page.
     *
     * @return View
     */
    public function index(): View
    {
        try {
            // Get statistics for the export page
            $stats = [
                'total_public_playlists' => Playlist::where('is_public', true)->count(),
                'total_private_playlists' => Playlist::where('is_public', false)->count(),
                'total_playlists' => Playlist::count(),
                'total_public_videos' => DB::table('videos')
                    ->join('playlists', 'videos.playlist_id', '=', 'playlists.id')
                    ->where('playlists.is_public', true)
                    ->count(),
                'total_private_videos' => DB::table('videos')
                    ->join('playlists', 'videos.playlist_id', '=', 'playlists.id')
                    ->where('playlists.is_public', false)
                    ->count(),
                'total_videos' => DB::table('videos')->count(),
                'total_users_with_public_content' => User::whereHas('playlists', static function ($query) {
                    $query->where('is_public', true);
                })->count(),
                'total_users_with_private_content' => User::whereHas('playlists', static function ($query) {
                    $query->where('is_public', false);
                })->count(),
                'total_users_with_content' => User::whereHas('playlists')->count()
            ];
        } catch (\Exception $e) {
            // Fallback stats if database is not available
            $stats = [
                'total_public_playlists' => 0,
                'total_private_playlists' => 0,
                'total_playlists' => 0,
                'total_public_videos' => 0,
                'total_private_videos' => 0,
                'total_videos' => 0,
                'total_users_with_public_content' => 0,
                'total_users_with_private_content' => 0,
                'total_users_with_content' => 0
            ];
        }

        return view('export.index', compact('stats'));
    }

    /**
     * Export all playlists (both public and private) and their content as YAML open data.
     *
     * @return Response
     */
    public function exportYaml()
    {
        try {
            // Get all playlists (both public and private) with their videos and users
            $playlists = Playlist::with(['videos', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

            $exportData = [
                'metadata' => [
                    'export_date' => now()->toISOString(),
                    'description' => 'Open data export of all playlists (public and private)',
                    'total_playlists' => $playlists->count(),
                    'total_public_playlists' => $playlists->where('is_public', true)->count(),
                    'total_private_playlists' => $playlists->where('is_public', false)->count(),
                    'privacy_notice' => 'Personal information has been anonymized with unique identifiers'
                ],
                'playlists' => []
            ];

            // Check if there are any playlists to export
            if ($playlists->isEmpty()) {
                $exportData['message'] = 'No playlists available for export at this time.';
            } else {
                foreach ($playlists as $playlist) {
                    // Create anonymous user identifier using hash
                    $userHash = $this->generateUserHash($playlist->user);

                    $playlistData = [
                        'id' => $playlist->id,
                        'title' => $playlist->title,
                        'description' => $playlist->description,
                        'visibility' => $playlist->is_public ? 'public' : 'private',
                        'created_at' => $playlist->created_at->toISOString(),
                        'updated_at' => $playlist->updated_at->toISOString(),
                        'user' => [
                            'anonymous_id' => $userHash,
                            'name_initials' => $this->getNameInitials($playlist->user)
                        ],
                        'videos' => []
                    ];

                    foreach ($playlist->videos as $video) {
                        $videoUserHash = $this->generateUserHash($video->user);

                        $playlistData['videos'][] = [
                            'id' => $video->id,
                            'title' => $video->title,
                            'youtube_id' => $video->youtube_id,
                            'youtube_url' => "https://www.youtube.com/watch?v={$video->youtube_id}",
                            'added_at' => $video->created_at->toISOString(),
                            'added_by' => [
                                'anonymous_id' => $videoUserHash,
                                'name_initials' => $this->getNameInitials($video->user)
                            ]
                        ];
                    }

                    $exportData['playlists'][] = $playlistData;
                }
            }

            // Convert to YAML
            $yamlContent = Yaml::dump($exportData, 4, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

            // Return as downloadable file
            return response($yamlContent)
                ->header('Content-Type', 'application/x-yaml')
                ->header('Content-Disposition', 'attachment; filename="playlists_complete_export_' . now()->format('Y-m-d_H-i-s') . '.yaml"');
        } catch (\Exception $e) {
            // Handle errors gracefully
            $errorData = [
                'metadata' => [
                    'export_date' => now()->toISOString(),
                    'status' => 'error',
                    'message' => 'Unable to generate export at this time'
                ],
                'error' => [
                    'description' => 'An error occurred while generating the export',
                    'suggestion' => 'Please try again later or contact support if the problem persists'
                ]
            ];

            $yamlContent = Yaml::dump($errorData, 4, 2);

            return response($yamlContent)
                ->header('Content-Type', 'application/x-yaml')
                ->header('Content-Disposition', 'attachment; filename="playlists_export_error_' . now()->format('Y-m-d_H-i-s') . '.yaml"');
        }
    }

    /**
     * Generate a unique hash for a user to anonymize their identity.
     *
     * @param User $user
     * @return string
     */
    private function generateUserHash(User $user): string
    {
        // Create a hash using user ID, username and password hash (which is already hashed in DB)
        return hash('sha256', $user->id . $user->username . $user->password);
    }

    /**
     * Get initials from user's first and last name for minimal identification.
     *
     * @param User $user
     * @return string
     */
    private function getNameInitials(User $user): string
    {
        $firstname = $user->firstname ?? '';
        $lastname = $user->lastname ?? '';

        $firstInitial = !empty($firstname) ? strtoupper($firstname[0]) : '';
        $lastInitial = !empty($lastname) ? strtoupper($lastname[0]) : '';

        return $firstInitial . $lastInitial;
    }
}
