<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $videos = Video::with(['playlist', 'user'])->latest()->get();

        return view('videos.index', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'youtube_id' => 'required|string|max:20',
            'title' => 'required|string|max:255',
        ]);

        // Check if the playlist belongs to the user
        $playlist = Playlist::findOrFail($validated['playlist_id']);
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated['user_id'] = Auth::id();

        // Check if video already exists in this playlist
        $existingVideo = Video::where('playlist_id', $validated['playlist_id'])
            ->where('youtube_id', $validated['youtube_id'])
            ->first();

        if ($existingVideo) {
            return back()->with('error', 'This video is already in the playlist.');
        }

        $video = Video::create($validated);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Video added successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $playlists = Playlist::where('user_id', Auth::id())->get();
        return view('videos.create', compact('playlists'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video): View
    {
        $video->load(['playlist', 'user']);
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video): View
    {
        // Only allow owner to edit
        if ($video->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $playlists = Playlist::where('user_id', Auth::id())->get();
        return view('videos.edit', compact('video', 'playlists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video): RedirectResponse
    {
        // Only allow owner to update
        if ($video->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'title' => 'required|string|max:255',
        ]);

        // Check if the new playlist belongs to the user
        $playlist = Playlist::findOrFail($validated['playlist_id']);
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $video->update($validated);

        return redirect()->route('videos.show', $video)
            ->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video): RedirectResponse
    {
        // Only allow owner to delete
        if ($video->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $playlist = $video->playlist;
        $video->delete();

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Video removed from playlist.');
    }
}
