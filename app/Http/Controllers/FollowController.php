<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FollowController extends Controller
{
    /**
     * Follow a user.
     */
    public function follow(User $user): RedirectResponse
    {
        $currentUser = Auth::user();

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        if ($currentUser->isFollowing($user)) {
            return back()->with('info', 'You are already following this user.');
        }

        $currentUser->follow($user);

        return back()->with('success', "You are now following {$user->fullname}.");
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user): RedirectResponse
    {
        $currentUser = Auth::user();

        if (!$currentUser->isFollowing($user)) {
            return back()->with('info', 'You are not following this user.');
        }

        $currentUser->unfollow($user);

        return back()->with('success', "You have unfollowed {$user->fullname}.");
    }

    /**
     * Show public playlists to discover.
     */
    public function discover(): View
    {
        $currentUser = Auth::user();

        // Get all public playlists with user relationship and video count
        $query = \App\Models\Playlist::where('is_public', true)
            ->with(['user', 'videos'])
            ->withCount('videos');

        // If user is authenticated, we can still show their own public playlists
        // but we'll handle follow buttons differently in the view

        $playlists = $query->latest()->get();

        return view('follows.discovery', compact('playlists'));
    }
}
