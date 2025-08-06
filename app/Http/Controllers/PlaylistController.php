<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaylistRequest;
use App\Http\Requests\UpdatePlaylistRequest;
use App\Models\Playlist;
use App\Models\Video;
use App\Services\YouTubeService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    /**
     * Display a listing of playlists.
     * Shows user's own playlists and public playlists from followed users
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        // Get user's own playlists
        $userPlaylists = Playlist::where('user_id', $user->id)
            ->withCount('videos')
            ->latest()
            ->get();

        // Get public playlists from followed users (for now, get all public playlists)
        $publicPlaylists = Playlist::where('is_public', true)
            ->where('user_id', '!=', $user->id)
            ->with('user')
            ->withCount('videos')
            ->latest()
            ->get();

        return view('playlists.index', compact('userPlaylists', 'publicPlaylists'));
    }

    /**
     * Show the form for creating a new playlist.
     */
    public function create(): View
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created playlist.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean'
        ]);

        // Get the authenticated user's ID explicitly
        $user = Auth::user();
        $validated['user_id'] = $user->id;
        $validated['is_public'] = $request->has('is_public');

        $playlist = Playlist::create($validated);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist created successfully.');
    }

    /**
     * Display the specified playlist with its videos.
     */
    public function show(Playlist $playlist): View
    {
        // Check if user can view this playlist
        if (!$playlist->is_public && $playlist->user_id !== Auth::id()) {
            abort(403, 'This playlist is private.');
        }

        $playlist->load(['videos' => function ($query) {
            $query->latest();
        }, 'user']);

        return view('playlists.show', compact('playlist'));
    }

    /**
     * Show the form for editing the playlist.
     */
    public function edit(Playlist $playlist): View
    {
        // Only allow owner to edit
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('playlists.edit', compact('playlist'));
    }

    /**
     * Update the specified playlist.
     */
    public function update(Request $request, Playlist $playlist): RedirectResponse
    {
        // Only allow owner to update
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean'
        ]);

        $validated['is_public'] = $request->has('is_public');

        $playlist->update($validated);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist updated successfully.');
    }

    /**
     * Remove the specified playlist.
     */
    public function destroy(Playlist $playlist): RedirectResponse
    {
        // Only allow owner to delete
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $playlist->delete();

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist deleted successfully.');
    }

    /**
     * Show form to add videos to playlist
     */
    public function addVideo(Playlist $playlist): View
    {
        // Only allow owner to add videos
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('playlists.add-video', compact('playlist'));
    }

    /**
     * Search YouTube videos
     */
    public function searchVideos(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return response()->json([]);
        }

        $videos = $this->youtubeService->searchVideos($query, 10);
        return response()->json($videos);
    }

    /**
     * Add a video to playlist
     */
    public function storeVideo(Request $request, Playlist $playlist): RedirectResponse
    {
        // Only allow owner to add videos
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'youtube_url' => 'nullable|url',
            'youtube_id' => 'nullable|string|max:20',
            'title' => 'required|string|max:255'
        ]);

        // Extract YouTube ID from URL if provided
        if (!empty($validated['youtube_url']) && empty($validated['youtube_id'])) {
            $videoId = $this->youtubeService->extractVideoId($validated['youtube_url']);
            if (!$videoId) {
                return back()->with('error', 'Invalid YouTube URL.');
            }
            $validated['youtube_id'] = $videoId;
        }

        if (empty($validated['youtube_id'])) {
            return back()->with('error', 'YouTube video ID is required.');
        }

        $validated['playlist_id'] = $playlist->id;
        $validated['user_id'] = Auth::id();

        // Check if video already exists in this playlist
        $existingVideo = Video::where('playlist_id', $playlist->id)
            ->where('youtube_id', $validated['youtube_id'])
            ->first();

        if ($existingVideo) {
            return back()->with('error', 'This video is already in the playlist.');
        }

        Video::create([
            'playlist_id' => $validated['playlist_id'],
            'user_id' => $validated['user_id'],
            'youtube_id' => $validated['youtube_id'],
            'title' => $validated['title']
        ]);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Video added to playlist successfully.');
    }

    /**
     * Play playlist - show first video and playlist queue
     */
    public function play(Playlist $playlist)
    {
        // Check if user can view this playlist
        if (!$playlist->is_public && $playlist->user_id !== Auth::id()) {
            abort(403, 'This playlist is private.');
        }

        $playlist->load(['videos' => function ($query) {
            $query->oldest('created_at'); // Play in order added
        }, 'user']);

        if ($playlist->videos->isEmpty()) {
            return redirect()->route('playlists.show', $playlist)
                ->with('error', 'This playlist is empty.');
        }

        return view('playlists.play', compact('playlist'));
    }
}
