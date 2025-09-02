@extends('layouts.app')

@section('title', 'Discover Users')

@section('content')
    <div class="min-vh-100 py-4">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Discover Users</h1>
                    <p class="text-muted mb-0">Find users with interesting playlists to follow</p>
                </div>
                <a href="{{ route('playlists.index') }}" class="btn btn-outline-secondary">
                    Back to Playlists
                </a>
            </div>

            <!-- Users List -->
            <div class="row g-4">
                @forelse($users as $user)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border shadow-sm" style="border-color: #e3e3e0;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <h5 class="fw-semibold mb-1">{{ $user->fullname }}</h5>
                                        <p class="text-muted small mb-0">{{ '@' . $user->username }}</p>
                                    </div>
                                    @auth
                                        @if (auth()->user()->isFollowing($user))
                                            <form action="{{ route('users.unfollow', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary fw-semibold">
                                                    Unfollow
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.follow', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm text-white fw-semibold"
                                                        style="background-color: #F53003; border-color: #F53003;"
                                                        onmouseover="this.style.backgroundColor='#d42a00'"
                                                        onmouseout="this.style.backgroundColor='#F53003'">
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                            Login to Follow
                                        </a>
                                    @endauth
                                </div>
                                <div class="small text-muted">
                                    {{ $user->public_playlists_count }} public playlist{{ $user->public_playlists_count !== 1 ? 's' : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 64px; height: 64px;">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 class="text-muted">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="h5 fw-semibold mb-2">No users to discover</h3>
                        <p class="text-muted mb-0">All users with public playlists are already being followed</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
