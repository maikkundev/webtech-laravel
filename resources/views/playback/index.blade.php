@extends('layouts.app')

@section('content')
    <div class="min-vh-100 py-4">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">
                        <i class="bi bi-play-btn me-2" style="color: #F53003;"></i>Content Playback
                    </h1>
                    <p class="text-muted mb-0">Select a playlist to start playing</p>
                </div>
            </div>

            <div class="card border shadow-sm" style="border-color: #e3e3e0;">
                <div class="card-body">
                    @if ($userPlaylists->isNotEmpty() || $followedUsersPlaylists->isNotEmpty())

                        @if ($userPlaylists->isNotEmpty())
                            <h2 class="h4 fw-semibold mb-4">
                                <i class="bi bi-person-fill me-2" style="color: #F53003;"></i>Your Playlists
                                ({{ $userPlaylists->count() }})
                            </h2>
                            <div class="row g-4 mb-5">
                                @foreach ($userPlaylists as $playlist)
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card h-100 border shadow-sm playlist-card"
                                            style="border-color: #e3e3e0;">
                                            <div class="position-relative playlist-thumbnail" style="height: 180px;">
                                                @if ($playlist->videos->isNotEmpty())
                                                    <img src="{{ $playlist->videos->first()->thumbnail_url }}"
                                                        alt="{{ $playlist->title }}" class="w-100 h-100"
                                                        style="object-fit: cover;">
                                                    <a href="{{ route('playlists.play', $playlist) }}"
                                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-decoration-none"
                                                        style="background-color: rgba(0,0,0,0); transition: background-color 0.3s;"
                                                        onmouseover="this.style.backgroundColor='rgba(0,0,0,0.4)'; this.querySelector('.play-btn').style.opacity='1'"
                                                        onmouseout="this.style.backgroundColor='rgba(0,0,0,0)'; this.querySelector('.play-btn').style.opacity='0'">
                                                        <div class="play-btn rounded-circle d-flex align-items-center justify-content-center"
                                                            style="background-color: #F53003; opacity: 0; transition: opacity 0.3s; width: 60px; height: 60px;">
                                                            <i class="bi bi-play-fill fs-3"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <div
                                                        class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                                        <i class="bi bi-music-note-beamed fs-1 text-muted"></i>
                                                    </div>
                                                @endif

                                                <div
                                                    class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 text-white p-2">
                                                    <small>
                                                        <i
                                                            class="bi bi-music-note-list me-1"></i>{{ $playlist->videos_count }}
                                                        videos
                                                    </small>
                                                </div>
                                                <div class="position-absolute top-0 end-0 m-2">
                                                    @if ($playlist->is_public)
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-globe"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">
                                                            <i class="bi bi-lock"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title fw-semibold">{{ Str::limit($playlist->title, 30) }}
                                                </h6>
                                                @if ($playlist->description)
                                                    <p class="card-text small text-muted">
                                                        {{ Str::limit($playlist->description, 60) }}</p>
                                                @endif
                                                <div class="d-flex gap-2 mt-auto">
                                                    <a href="{{ route('playlists.play', $playlist) }}"
                                                        class="btn text-white btn-sm flex-fill fw-semibold"
                                                        style="background-color: #F53003; border-color: #F53003;"
                                                        onmouseover="this.style.backgroundColor='#d42a00'"
                                                        onmouseout="this.style.backgroundColor='#F53003'">
                                                        <i class="bi bi-play-fill me-1"></i>Play
                                                    </a>
                                                    <a href="{{ route('playlists.show', $playlist) }}"
                                                        class="btn btn-outline-secondary btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($followedUsersPlaylists->isNotEmpty())
                            <h2 class="h4 fw-semibold mb-4">
                                <i class="bi bi-heart-fill me-2" style="color: #F53003;"></i>From Users You Follow
                                ({{ $followedUsersPlaylists->count() }})
                            </h2>
                            <div class="row g-4">
                                @foreach ($followedUsersPlaylists as $playlist)
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card h-100 border shadow-sm playlist-card"
                                            style="border-color: #e3e3e0;">
                                            <div class="position-relative playlist-thumbnail" style="height: 180px;">
                                                @if ($playlist->videos->isNotEmpty())
                                                    <img src="{{ $playlist->videos->first()->thumbnail_url }}"
                                                        alt="{{ $playlist->title }}" class="w-100 h-100"
                                                        style="object-fit: cover;">
                                                    <a href="{{ route('playlists.play', $playlist) }}"
                                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-decoration-none"
                                                        style="background-color: rgba(0,0,0,0); transition: background-color 0.3s;"
                                                        onmouseover="this.style.backgroundColor='rgba(0,0,0,0.4)'; this.querySelector('.play-btn').style.opacity='1'"
                                                        onmouseout="this.style.backgroundColor='rgba(0,0,0,0)'; this.querySelector('.play-btn').style.opacity='0'">
                                                        <div class="play-btn rounded-circle d-flex align-items-center justify-content-center"
                                                            style="background-color: #F53003; opacity: 0; transition: opacity 0.3s; width: 60px; height: 60px;">
                                                            <i class="bi bi-play-fill fs-3"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <div
                                                        class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                                        <i class="bi bi-music-note-beamed fs-1 text-muted"></i>
                                                    </div>
                                                @endif

                                                <div
                                                    class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 text-white p-2">
                                                    <small>
                                                        <i
                                                            class="bi bi-music-note-list me-1"></i>{{ $playlist->videos_count }}
                                                        videos
                                                    </small>
                                                </div>
                                                <div class="position-absolute top-0 end-0 m-2">
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-globe"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title fw-semibold">{{ Str::limit($playlist->title, 30) }}
                                                </h6>
                                                <p class="small text-muted mb-1">
                                                    <i class="bi bi-person me-1"></i>by {{ $playlist->user->fullname }}
                                                </p>
                                                @if ($playlist->description)
                                                    <p class="card-text small text-muted">
                                                        {{ Str::limit($playlist->description, 50) }}</p>
                                                @endif
                                                <div class="d-flex gap-2 mt-auto">
                                                    <a href="{{ route('playlists.play', $playlist) }}"
                                                        class="btn text-white btn-sm flex-fill fw-semibold"
                                                        style="background-color: #F53003; border-color: #F53003;"
                                                        onmouseover="this.style.backgroundColor='#d42a00'"
                                                        onmouseout="this.style.backgroundColor='#F53003'">
                                                        <i class="bi bi-play-fill me-1"></i>Play
                                                    </a>
                                                    <a href="{{ route('playlists.show', $playlist) }}"
                                                        class="btn btn-outline-secondary btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 80px; height: 80px; background-color: #f8f9fa;">
                                <i class="bi bi-music-note-beamed text-muted" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-semibold mt-3">No playlists available for playback</h5>
                            <p class="text-muted">Create your own playlists or follow users with public playlists to get
                                started.</p>
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <a href="{{ route('playlists.create') }}" class="btn text-white fw-semibold"
                                    style="background-color: #F53003; border-color: #F53003;"
                                    onmouseover="this.style.backgroundColor='#d42a00'"
                                    onmouseout="this.style.backgroundColor='#F53003'">
                                    <i class="bi bi-plus-circle me-2"></i>Create Playlist
                                </a>
                                <a href="{{ route('users.discover') }}" class="btn btn-outline-secondary fw-semibold">
                                    <i class="bi bi-search me-2"></i>Discover Users
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        .playlist-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .playlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
@endsection
