@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-lg py-5">
        <div class="card border shadow-sm" style="background-color: white; border-color: #e3e3e0;">
            <div class="card-header border-bottom d-flex justify-content-between align-items-start"
                 style="border-color: #e3e3e0;">
                <div>
                    <h1 class="h4 fw-semibold mb-1" style="color: #1b1b18;">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </h1>
                    <p class="text-muted small mb-0">@{{ $user - > username }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-sm text-white"
                   style="background-color: #F53003; border-color: #F53003;">
                    Edit Profile
                </a>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- User Information -->
                    <div class="col-md-6">
                        <h2 class="h5 fw-medium mb-3" style="color: #1b1b18;">User Information</h2>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Full Name</label>
                            <p class="mb-0" style="color: #1b1b18;">{{ $user->firstname }} {{ $user->lastname }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Username</label>
                            <p class="mb-0" style="color: #1b1b18;">{{ $user->username }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Email</label>
                            <p class="mb-0" style="color: #1b1b18;">{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Member Since</label>
                            <p class="mb-0" style="color: #1b1b18;">{{ $user->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="col-md-6">
                        <h2 class="h5 fw-medium mb-3" style="color: #1b1b18;">Statistics</h2>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 rounded" style="background-color: #f9f9f8;">
                                    <div class="h4 fw-semibold mb-1"
                                         style="color: #F53003;">{{ $playlists->count() }}</div>
                                    <div class="small text-muted">Playlists</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded" style="background-color: #f9f9f8;">
                                    <div class="h4 fw-semibold mb-1"
                                         style="color: #F53003;">{{ $user->videos->count() }}
                                    </div>
                                    <div class="small text-muted">Videos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Playlists -->
        @if ($playlists->count() > 0)
            <div class="card border shadow-sm mt-4" style="background-color: white; border-color: #e3e3e0;">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center"
                     style="border-color: #e3e3e0;">
                    <h2 class="h5 fw-semibold mb-0" style="color: #1b1b18;">Recent Playlists</h2>
                    <a href="{{ route('playlists.index') }}" class="text-decoration-none small" style="color: #F53003;">
                        View All
                    </a>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        @foreach ($playlists->take(6) as $playlist)
                            <div class="col-md-6 col-lg-4">
                                <div class="p-3 rounded h-100" style="background-color: #f9f9f8;">
                                    <h3 class="fw-medium mb-2" style="color: #1b1b18;">
                                        <a href="{{ route('playlists.show', $playlist) }}" class="text-decoration-none"
                                           style="color: #1b1b18;">
                                            {{ $playlist->title }}
                                        </a>
                                    </h3>
                                    @if ($playlist->description)
                                        <p class="small text-muted mb-2">
                                            {{ Str::limit($playlist->description, 100) }}
                                        </p>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center text-muted"
                                         style="font-size: 0.75rem;">
                                        <span>{{ $playlist->videos->count() }} videos</span>
                                        <span>{{ $playlist->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card border shadow-sm mt-4 text-center" style="background-color: white; border-color: #e3e3e0;">
                <div class="card-body py-5">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         class="mx-auto text-muted mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19V6l12-3v13M9 19c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2zm12-3c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2z"/>
                    </svg>
                    <h3 class="h6 fw-medium" style="color: #1b1b18;">No playlists yet</h3>
                    <p class="text-muted small">Get started by creating your first playlist.</p>
                    <div class="mt-3">
                        <a href="{{ route('playlists.create') }}" class="btn text-white"
                           style="background-color: #F53003; border-color: #F53003;">
                            Create Playlist
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
