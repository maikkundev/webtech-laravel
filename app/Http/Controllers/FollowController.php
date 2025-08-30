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
     * Show users to discover and follow.
     */
    public function discover(): View
    {
        $currentUser = Auth::user();

        // Get all users with public playlists (excluding self)
        $users = User::where('id', '!=', $currentUser->id)
                    ->withCount(['playlists as public_playlists_count' => function ($query) {
                        $query->where('is_public', true);
                    }])
                    ->having('public_playlists_count', '>', 0)
                    ->latest()
                    ->get();

        return view('follows.discovery', compact('users'));
    }
}
