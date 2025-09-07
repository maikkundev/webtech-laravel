@extends('layouts.app')

@section('content')
    <div class="min-vh-100 py-4">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">
                        <i class="bi bi-people me-2" style="color: #F53003;"></i>Manage Followed Users
                    </h1>
                    <p class="text-muted mb-0">Manage who you follow and discover new users</p>
                </div>
            </div>

            <div class="card border shadow-sm" style="border-color: #e3e3e0;">
                <div class="card-body">
                    @if ($followedUsers->isNotEmpty())
                        <h2 class="h4 fw-semibold mb-4">
                            <i class="bi bi-heart-fill me-2" style="color: #F53003;"></i>Users You Follow
                            ({{ $followedUsers->count() }})
                        </h2>
                        <div class="row g-4 mb-5">
                            @foreach ($followedUsers as $user)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card h-100 border shadow-sm" style="border-color: #e3e3e0;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width: 50px; height: 50px; background-color: #F53003;">
                                                    <i class="bi bi-person-fill text-white fs-4"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title mb-0 fw-semibold">{{ $user->fullname }}</h6>
                                                    <small class="text-muted">{{ '@' . $user->username }}</small>
                                                </div>
                                            </div>
                                            <p class="card-text small text-muted mb-3">
                                                <i class="bi bi-music-note-list me-1"></i>
                                                {{ $user->playlists_count }}
                                                {{ Str::plural('playlist', $user->playlists_count) }}
                                            </p>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('users.discover') }}?user={{ $user->id }}"
                                                    class="btn btn-outline-secondary btn-sm flex-fill fw-semibold">
                                                    <i class="bi bi-eye me-1"></i>View
                                                </a>
                                                <form method="POST" action="{{ route('users.unfollow', $user) }}"
                                                    class="flex-fill">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm w-100 fw-semibold"
                                                        onclick="return confirm('Are you sure you want to unfollow {{ $user->fullname }}?')">
                                                        <i class="bi bi-heart-break me-1"></i>Unfollow
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 80px; height: 80px; background-color: #f8f9fa;">
                                <i class="bi bi-people text-muted" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-semibold mt-3">You're not following anyone yet</h5>
                            <p class="text-muted">Discover users with interesting playlists to follow.</p>
                        </div>
                    @endif

                    @if ($suggestedUsers->isNotEmpty())
                        <hr class="my-5">
                        <h2 class="h4 fw-semibold mb-4">
                            <i class="bi bi-compass me-2" style="color: #F53003;"></i>Suggested Users to Follow
                        </h2>
                        <div class="row g-4 mb-5">
                            @foreach ($suggestedUsers as $user)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card h-100 border shadow-sm" style="border-color: #e3e3e0;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width: 50px; height: 50px; background-color: #6c757d;">
                                                    <i class="bi bi-person-plus-fill text-white fs-4"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title mb-0 fw-semibold">{{ $user->fullname }}</h6>
                                                    <small class="text-muted">{{ '@' . $user->username }}</small>
                                                </div>
                                            </div>
                                            <p class="card-text small text-muted mb-3">
                                                <i class="bi bi-music-note-list me-1"></i>
                                                {{ $user->playlists_count }} public
                                                {{ Str::plural('playlist', $user->playlists_count) }}
                                            </p>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('users.discover') }}?user={{ $user->id }}"
                                                    class="btn btn-outline-secondary btn-sm flex-fill fw-semibold">
                                                    <i class="bi bi-eye me-1"></i>Preview
                                                </a>
                                                <form method="POST" action="{{ route('users.follow', $user) }}"
                                                    class="flex-fill">
                                                    @csrf
                                                    <button type="submit" class="btn text-white btn-sm w-100 fw-semibold"
                                                        style="background-color: #F53003; border-color: #F53003;"
                                                        onmouseover="this.style.backgroundColor='#d42a00'"
                                                        onmouseout="this.style.backgroundColor='#F53003'">
                                                        <i class="bi bi-heart me-1"></i>Follow
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('users.discover') }}" class="btn btn-outline-secondary fw-semibold">
                            <i class="bi bi-search me-2"></i>Discover More Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
