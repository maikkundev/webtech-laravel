@extends('layouts.app')

@section('title', $playlist->title)

@section('content')
    <div class="min-vh-100 py-5" style="background-color: #FDFDFC;">
        <div class="container-xxl">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('playlists.index') }}" class="text-muted me-3 text-decoration-none"
                       style="color: #706f6c !important;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div class="flex-fill">
                        <div class="d-flex align-items-center mb-2">
                            <h1 class="display-6 fw-bold me-3 mb-0" style="color: #1b1b18;">{{ $playlist->title }}</h1>
                            @if ($playlist->is_public)
                                <span class="badge bg-success">Public</span>
                            @else
                                <span class="badge bg-secondary">Private</span>
                            @endif
                        </div>
                        <div class="d-flex align-items-center text-muted small">
                            <span>by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $playlist->videos->count() }} videos</span>
                            <span class="mx-2">•</span>
                            <span>Created {{ $playlist->created_at->diffForHumans() }}</span>
                        </div>
                        @if ($playlist->description)
                            <p class="text-muted mt-2 mb-0">{{ $playlist->description }}</p>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex align-items-center gap-3">
                    @if ($playlist->videos->count() > 0)
                        <a href="{{ route('playlists.play', $playlist) }}"
                           class="btn text-white d-flex align-items-center"
                           style="background-color: #F53003; border-color: #F53003;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="me-2">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Play All
                        </a>
                    @endif

                    @if ($playlist->user_id === Auth::id())
                        <a href="{{ route('playlists.add-video', $playlist) }}" class="btn btn-outline-secondary">
                            Add Videos
                        </a>
                        <a href="{{ route('playlists.edit', $playlist) }}"
                           class="btn btn-link text-muted text-decoration-none">
                            Edit Playlist
                        </a>
                    @endif
                </div>
            </div>

            <!-- Videos List -->
            @if ($playlist->videos->count() > 0)
                <div class="card border" style="background-color: white; border-color: #e3e3e0;">
                    <div class="card-header border-bottom" style="border-color: #e3e3e0;">
                        <h2 class="h5 fw-semibold mb-0" style="color: #1b1b18;">Videos ({{ $playlist->videos->count() }}
                            )
                        </h2>
                    </div>

                    <div class="list-group list-group-flush">
                        @foreach ($playlist->videos as $index => $video)
                            <div class="list-group-item border-0 border-bottom"
                                 style="border-color: #e3e3e0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Video Index -->
                                    <div class="flex-shrink-0 text-center" style="width: 32px;">
                                        <span class="text-muted small fw-medium">{{ $index + 1 }}</span>
                                    </div>

                                    <!-- Video Thumbnail -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="rounded"
                                             style="width: 96px; height: 64px; object-fit: cover;">
                                    </div>

                                    <!-- Video Info -->
                                    <div class="flex-fill">
                                        <h3 class="h6 fw-semibold text-truncate mb-1" style="color: #1b1b18;">
                                            {{ $video->title }}
                                        </h3>
                                        <p class="text-muted small mb-0">
                                            Added {{ $video->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary p-2">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                        @if ($playlist->user_id === Auth::id())
                                            <form action="{{ route('videos.destroy', $video) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Remove this video from the playlist?')"
                                                        class="btn btn-sm btn-outline-danger p-2">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="card border text-center p-5" style="background-color: white; border-color: #e3e3e0;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px; background-color: #f8f9fa;">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             class="text-muted">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="h5 fw-semibold mb-2" style="color: #1b1b18;">No videos in this playlist</h3>
                    <p class="text-muted mb-4">Start building your playlist by adding some videos</p>
                    @if ($playlist->user_id === Auth::id())
                        <a href="{{ route('playlists.add-video', $playlist) }}" class="btn text-white"
                           style="background-color: #F53003; border-color: #F53003;">
                            Add First Video
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
