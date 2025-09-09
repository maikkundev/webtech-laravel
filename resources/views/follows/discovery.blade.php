@extends('layouts.app')

@section('title', 'Discover Playlists')

@section('content')
    <div class="min-vh-100 py-4">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if ($viewingUser)
                        <h1 class="h3 fw-bold mb-1">{{ $viewingUser->fullname }}'s Public Playlists</h1>
                        <p class="text-muted mb-0">Viewing public playlists by {{ '@' . $viewingUser->username }}</p>
                    @else
                        <h1 class="h3 fw-bold mb-1">Discover Public Playlists</h1>
                        <p class="text-muted mb-0">Explore public playlists from the community</p>
                    @endif
                </div>
                @if ($viewingUser)
                    <a href="{{ route('users.discover') }}" class="btn btn-outline-secondary">
                        Back to All Playlists
                    </a>
                @else
                    <a href="{{ route('playlists.index') }}" class="btn btn-outline-secondary">
                        Back to Playlists
                    </a>
                @endif
            </div>

            <!-- Playlists List -->
            <div class="row g-4">
                @forelse($playlists as $playlist)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('playlists.partials.playlist-card', [
                            'playlist' => $playlist,
                            'showOwner' => true,
                            'showFollowButton' => true,
                        ])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 64px; height: 64px;">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="text-muted">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16">
                                </path>
                            </svg>
                        </div>
                        <h3 class="h5 fw-semibold mb-2">No public playlists found</h3>
                        <p class="text-muted mb-0">There are no public playlists available to discover at the moment</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
