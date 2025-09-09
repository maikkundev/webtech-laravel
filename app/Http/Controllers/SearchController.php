<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display the search page with form.
     */
    public function index(): View
    {
        return view('search.index');
    }

    /**
     * Handle the search request and display results.
     */
    public function search(Request $request): View
    {
        $request->validate([
            'text_query' => 'nullable|string|max:255',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'user_query' => 'nullable|string|max:255',
            'sort' => 'nullable|string|in:created_at_desc,created_at_asc,title_asc,title_desc,videos_count_desc,videos_count_asc'
        ]);

        $textQuery = $request->input('text_query');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $userQuery = $request->input('user_query');
        $sort = $request->input('sort', 'created_at_desc'); // Default sort
        $perPage = 25; // Default to 25 results per page

        // Start with base query for public playlists with related data
        $query = Playlist::with(['user', 'videos'])
            ->where('is_public', true)
            ->withCount('videos');

        // Search by text in playlist title or video titles
        if ($textQuery) {
            $query->where(function ($q) use ($textQuery) {
                // Search in playlist title
                $q->where('title', 'LIKE', '%' . $textQuery . '%')
                    ->orWhere('description', 'LIKE', '%' . $textQuery . '%')
                    // Search in video titles within the playlist
                    ->orWhereHas('videos', function ($videoQuery) use ($textQuery) {
                        $videoQuery->where('title', 'LIKE', '%' . $textQuery . '%');
                    });
            });
        }

        // Search by date range (playlist creation date)
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // Search by user information (firstname, lastname, username, email)
        if ($userQuery) {
            $query->whereHas('user', function ($userQueryBuilder) use ($userQuery) {
                $userQueryBuilder->where(function ($q) use ($userQuery) {
                    $q->where('firstname', 'LIKE', '%' . $userQuery . '%')
                        ->orWhere('lastname', 'LIKE', '%' . $userQuery . '%')
                        ->orWhere('username', 'LIKE', '%' . $userQuery . '%')
                        ->orWhere('email', 'LIKE', '%' . $userQuery . '%');
                });
            });
        }

        // Apply sorting
        switch ($sort) {
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'videos_count_desc':
                $query->orderBy('videos_count', 'desc');
                break;
            case 'videos_count_asc':
                $query->orderBy('videos_count', 'asc');
                break;
            case 'created_at_desc':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Get paginated results
        $playlists = $query->paginate($perPage)
            ->withQueryString(); // Preserve query parameters in pagination links

        return view('search.results', compact('playlists', 'textQuery', 'dateFrom', 'dateTo', 'userQuery', 'sort'));
    }
}
