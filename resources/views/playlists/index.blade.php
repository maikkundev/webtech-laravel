@extends('layouts.app')

@section('title', 'Playlists')

@section('content')
    <div class="min-vh-100 py-4" style="">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Playlists</h1>
                    <p class="text-muted mb-0">Manage your video playlists and discover others</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('users.discover') }}" class="btn btn-outline-secondary fw-semibold">
                        Discover Users
                    </a>
                    <a href="{{ route('playlists.create') }}" class="btn text-white fw-semibold"
                       style="background-color: #F53003; border-color: #F53003;"
                       onmouseover="this.style.backgroundColor='#d42a00'" onmouseout="this.style.backgroundColor='#F53003'">
                        Create Playlist
                    </a>
                </div>
            </div>

            <!-- My Playlists Section -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="h4 fw-semibold mb-0">My Playlists</h2>
                    <span class="small text-muted">{{ $userPlaylists->count() }} playlists</span>
                </div>

                <div class="row g-4">
                    @forelse($userPlaylists as $playlist)
                        <div class="col-12 col-md-6 col-lg-4">
                            @include('playlists.partials.playlist-card', [
                                'playlist' => $playlist,
                                'showOwner' => false,
                            ])
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 64px; height: 64px;">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     class="text-muted">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="h5 fw-semibold mb-2">No playlists yet</h3>
                            <p class="text-muted mb-3">Create your first playlist to get started</p>
                            <a href="{{ route('playlists.create') }}" class="btn text-white fw-semibold"
                               style="background-color: #F53003; border-color: #F53003;"
                               onmouseover="this.style.backgroundColor='#d42a00'"
                               onmouseout="this.style.backgroundColor='#F53003'">
                                Create Your First Playlist
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Following Users' Playlists Section -->
            @if ($followedUsersPlaylists->count() > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="h4 fw-semibold mb-0">From People You Follow</h2>
                        <span class="small text-muted">{{ $followedUsersPlaylists->count() }} playlists</span>
                    </div>

                    <div class="row g-4">
                        @foreach ($followedUsersPlaylists as $playlist)
                            <div class="col-12 col-md-6 col-lg-4">
                                @include('playlists.partials.playlist-card', [
                                    'playlist' => $playlist,
                                    'showOwner' => true,
                                    'showFollowButton' => false,
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Other Public Playlists Section -->
            @if ($otherPublicPlaylists->count() > 0)
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="h4 fw-semibold mb-0">Discover Public Playlists</h2>
                        <span class="small text-muted">{{ $otherPublicPlaylists->count() }} playlists</span>
                    </div>

                    <div class="row g-4">
                        @foreach ($otherPublicPlaylists as $playlist)
                            <div class="col-12 col-md-6 col-lg-4">
                                @include('playlists.partials.playlist-card', [
                                    'playlist' => $playlist,
                                    'showOwner' => true,
                                    'showFollowButton' => true,
                                ])
                            </div>
                        @endforeach
                    </div>

                    @if ($otherPublicPlaylists->count() >= 6)
                        <div class="text-center mt-4">
                            <a href="{{ route('users.discover') }}" class="btn btn-outline-secondary">
                                Discover More Users
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
