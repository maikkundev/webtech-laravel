@extends('layouts.app')

@section('title', $playlist->title)

@section('content')
    <div class="min-vh-100 py-5">
        <div class="container-xxl">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('playlists.index') }}" class="text-muted me-3 text-decoration-none">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div class="flex-fill">
                        <div class="d-flex align-items-center mb-2">
                            <h1 class="display-6 fw-bold me-3 mb-0">{{ $playlist->title }}</h1>
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
                        <a href="{{ route('playlists.play', $playlist) }}" class="btn btn-danger d-flex align-items-center">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="me-2">
                                <path d="M8 5v14l11-7z" />
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
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 fw-semibold mb-0">Videos (<span
                                id="video-counter">{{ $playlist->videos->count() }}</span>)
                        </h2>
                    </div>

                    <div class="list-group list-group-flush">
                        @foreach ($playlist->videos as $index => $video)
                            <div class="list-group-item border-0 border-bottom">
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
                                        <h3 class="h6 fw-semibold text-truncate mb-1">
                                            {{ $video->title }}
                                        </h3>
                                        <p class="text-muted small mb-0">
                                            Added {{ $video->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary p-2">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
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
                <div class="card text-center p-5">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 bg-light"
                        style="width: 80px; height: 80px;">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="text-muted">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="h5 fw-semibold mb-2">No videos in this playlist</h3>
                    <p class="text-muted mb-4">Start building your playlist by adding some videos</p>
                    @if ($playlist->user_id === Auth::id())
                        <a href="{{ route('playlists.add-video', $playlist) }}" class="btn btn-danger">
                            Add First Video
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        #video-counter {
            display: inline-block;
            transition: all 0.3s ease;
            color: #007bff;
            font-weight: bold;
        }

        .counting-animation {
            animation: countPulse 0.2s ease-in-out;
            color: #ff6b6b !important;
            transform: scale(1.1);
        }

        @keyframes countPulse {
            0% {
                transform: scale(1);
                color: #007bff;
            }

            50% {
                transform: scale(1.15);
                color: #ff6b6b;
            }

            100% {
                transform: scale(1.1);
                color: #ff6b6b;
            }
        }

        .final-count {
            animation: finalPulse 0.5s ease-in-out;
            color: #28a745 !important;
        }

        @keyframes finalPulse {
            0% {
                transform: scale(1.1);
                color: #ff6b6b;
            }

            50% {
                transform: scale(1.3);
                color: #ffc107;
            }

            100% {
                transform: scale(1);
                color: #28a745;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoCounter = document.getElementById('video-counter');
            if (!videoCounter) return;

            const finalCount = parseInt(videoCounter.textContent);
            if (finalCount === 0) return; // Don't animate if no videos

            // Start countdown from a number higher than the actual count (at least 10)
            const startCount = Math.max(finalCount + 100, 20);
            let currentCount = startCount;

            function updateCount() {
                videoCounter.classList.add('counting-animation');
                videoCounter.textContent = currentCount;

                setTimeout(() => {
                    videoCounter.classList.remove('counting-animation');
                }, 200);

                currentCount--;

                if (currentCount > finalCount) {
                    // Continue countdown with fast intervals
                    setTimeout(updateCount, 150); // Very fast - 150ms intervals
                } else {
                    // Final animation when reaching the actual count
                    setTimeout(() => {
                        videoCounter.textContent = finalCount;
                        videoCounter.classList.add('final-count');

                        setTimeout(() => {
                            videoCounter.classList.remove('final-count');
                        }, 500);
                    }, 300);
                }
            }

            // Start the countdown after a brief delay
            setTimeout(updateCount, 500);
        });
    </script>
@endsection
