@extends('layouts.app')

@section('title', 'All Videos')

@section('content')
    <div class="min-vh-100 py-4" style="background-color: #FDFDFC;">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1" style="color: #1b1b18;">All Videos</h1>
                    <p class="text-muted mb-0">Browse all videos from playlists</p>
                </div>
            </div>

            <!-- Videos Grid -->
            @if ($videos->count() > 0)
                <div class="row g-4">
                    @foreach ($videos as $video)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="card h-100 border shadow-sm"
                                 style="background-color: white; border-color: #e3e3e0;">
                                <!-- Video Thumbnail -->
                                <div class="position-relative">
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                                         class="card-img-top"
                                         style="height: 192px; object-fit: cover;">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center overlay-hover"
                                        style="background-color: rgba(0,0,0,0); transition: background-color 0.3s;"
                                        onmouseover="this.style.backgroundColor='rgba(0,0,0,0.4)'; this.querySelector('.play-btn').style.opacity='1'"
                                        onmouseout="this.style.backgroundColor='rgba(0,0,0,0)'; this.querySelector('.play-btn').style.opacity='0'">
                                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}"
                                           target="_blank"
                                           class="btn rounded-circle p-3 text-white play-btn"
                                           style="background-color: #F53003; opacity: 0; transition: opacity 0.3s;">
                                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title fw-semibold mb-2 text-truncate"
                                        style="color: #1b1b18; height: 1.5em; overflow: hidden;">
                                        {{ $video->title }}
                                    </h5>

                                    <div class="small text-muted mb-3">
                                        <p class="mb-1">
                                            From:
                                            <a href="{{ route('playlists.show', $video->playlist) }}"
                                               class="text-decoration-none fw-medium" style="color: #F53003;"
                                               onmouseover="this.style.color='#d42a00'"
                                               onmouseout="this.style.color='#F53003'">
                                                {{ $video->playlist->title }}
                                            </a>
                                        </p>
                                        <p class="mb-1">
                                            By: {{ $video->user->firstname }} {{ $video->user->lastname }}</p>
                                        <p class="mb-0">Added {{ $video->created_at->diffForHumans() }}</p>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('playlists.show', $video->playlist) }}"
                                           class="text-decoration-none small fw-medium" style="color: #F53003;"
                                           onmouseover="this.style.color='#d42a00'"
                                           onmouseout="this.style.color='#F53003'">
                                            View Playlist
                                        </a>
                                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}"
                                           target="_blank"
                                           class="text-decoration-none small fw-medium text-muted">
                                            Watch on YouTube
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px; background-color: #f8f9fa;">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             class="text-muted">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="h5 fw-semibold mb-2" style="color: #1b1b18;">No videos yet</h3>
                    <p class="text-muted mb-4">Videos will appear here when they are added to playlists</p>
                    <a href="{{ route('playlists.index') }}" class="btn text-white fw-semibold"
                       style="background-color: #F53003; border-color: #F53003;"
                       onmouseover="this.style.backgroundColor='#d42a00'"
                       onmouseout="this.style.backgroundColor='#F53003'">
                        Browse Playlists
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
