@extends('layouts.app')

@section('title', 'Playing: ' . $playlist->title)

@section('content')
    <div class="min-vh-100" style="padding: 2rem 0;">
        <div class="container-xxl">
            <!-- Header -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('playlists.show', $playlist) }}" class="text-muted me-3 text-decoration-none"
                        style="color: #706f6c !important;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="display-5 fw-bold">{{ $playlist->title }}</h1>
                        <p class="text-muted" style="color: #706f6c;">by {{ $playlist->user->firstname }}
                            {{ $playlist->user->lastname }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Video Player -->
                <div class="col-lg-8">
                    <div class="card border" style="border-color: #e3e3e0;">
                        <!-- YouTube Embed -->
                        <div class="ratio ratio-16x9" style="background-color: #f8f9fa;">
                            <iframe id="youtube-player" class="border-0"
                                src="https://www.youtube.com/embed/{{ $playlist->videos->first()->youtube_id }}?autoplay=1&rel=0&modestbranding=1"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- Video Info -->
                        <div class="card-body">
                            <h2 id="current-video-title" class="h4 fw-bold mb-2">
                                {{ $playlist->videos->first()->title }}
                            </h2>
                            <div class="d-flex align-items-center justify-content-between small text-muted">
                                <span id="video-index">1 of {{ $playlist->videos->count() }}</span>
                                <span>Added {{ $playlist->videos->first()->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Player Controls -->
                    <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                        <button id="prev-btn" onclick="previousVideo()" class="btn btn-outline-secondary p-3 border"
                            style="background-color: white; border-color: #e3e3e0;" disabled>
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z" />
                            </svg>
                        </button>
                        <button id="next-btn" onclick="nextVideo()" class="btn btn-outline-secondary p-3 border"
                            style="background-color: white; border-color: #e3e3e0;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Playlist Queue -->
                <div class="col-lg-4">
                    <div class="card border" style="border-color: #e3e3e0;">
                        <div class="card-header border-bottom" style="border-color: #e3e3e0;">
                            <h3 class="h5 fw-semibold mb-0">
                                Playlist Queue ({{ $playlist->videos->count() }})
                            </h3>
                        </div>

                        <div class="overflow-auto" style="max-height: 500px;">
                            @foreach ($playlist->videos as $index => $video)
                                <div class="video-item d-flex align-items-center p-3 border-bottom position-relative {{ $index === 0 ? 'current-video' : '' }}"
                                    style="cursor: pointer; border-color: #e3e3e0;" data-index="{{ $index }}"
                                    data-video-id="{{ $video->youtube_id }}" data-title="{{ $video->title }}"
                                    data-created="{{ $video->created_at->diffForHumans() }}"
                                    onclick="playVideo({{ $index }})">

                                    <!-- Video Index -->
                                    <div class="flex-shrink-0 text-center" style="width: 32px;">
                                        <span class="text-muted small fw-medium">{{ $index + 1 }}</span>
                                    </div>

                                    <!-- Video Thumbnail -->
                                    <div class="flex-shrink-0 position-relative me-3">
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="rounded"
                                            style="width: 64px; height: 48px; object-fit: cover;">
                                        @if ($index === 0)
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded"
                                                style="background-color: rgba(0,0,0,0.5);">
                                                <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Video Info -->
                                    <div class="flex-fill text-truncate">
                                        <h4 class="small fw-medium mb-1 text-truncate">
                                            {{ $video->title }}
                                        </h4>
                                        <p class="text-muted" style="font-size: 0.75rem; margin-bottom: 0;">
                                            Added {{ $video->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentVideoIndex = 0;

        @php
            $videoData = $playlist->videos
                ->map(function ($video, $index) {
                    return [
                        'index' => $index,
                        'youtube_id' => $video->youtube_id,
                        'title' => $video->title,
                        'created_at' => $video->created_at->diffForHumans(),
                    ];
                })
                ->values()
                ->toArray();
        @endphp
        const videos = @json($videoData)

        function playVideo(index) {
            if (index < 0 || index >= videos.length) return;

            currentVideoIndex = index;
            const video = videos[index];

            // Update YouTube iframe
            document.getElementById('youtube-player').src =
                `https://www.youtube.com/embed/${video.youtube_id}?autoplay=1&rel=0`;

            // Update video info
            document.getElementById('current-video-title').textContent = video.title;
            document.getElementById('video-index').textContent = `${index + 1} of ${videos.length}`;

            // Update queue highlighting
            document.querySelectorAll('.video-item').forEach((item, i) => {
                if (i === index) {
                    item.classList.add('current-video', 'bg-light');
                    // Add play icon overlay
                    const thumbnail = item.querySelector('img').parentElement;
                    thumbnail.classList.add('position-relative');
                    if (!thumbnail.querySelector('.position-absolute')) {
                        thumbnail.innerHTML += `
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded" style="background-color: rgba(0,0,0,0.5);">
                        <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                `;
                    }
                } else {
                    item.classList.remove('current-video', 'bg-light');
                    // Remove play icon overlay
                    const overlay = item.querySelector('.position-absolute');
                    if (overlay) overlay.remove();
                }
            });

            // Update navigation buttons
            document.getElementById('prev-btn').disabled = index === 0;
            document.getElementById('next-btn').disabled = index === videos.length - 1;

            // Update button styles based on disabled state
            updateButtonStyles();
        }

        function previousVideo() {
            if (currentVideoIndex > 0) {
                playVideo(currentVideoIndex - 1);
            }
        }

        function nextVideo() {
            if (currentVideoIndex < videos.length - 1) {
                playVideo(currentVideoIndex + 1);
            }
        }

        function updateButtonStyles() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (prevBtn.disabled) {
                prevBtn.classList.add('opacity-50');
                prevBtn.style.cursor = 'not-allowed';
            } else {
                prevBtn.classList.remove('opacity-50');
                prevBtn.style.cursor = 'pointer';
            }

            if (nextBtn.disabled) {
                nextBtn.classList.add('opacity-50');
                nextBtn.style.cursor = 'not-allowed';
            } else {
                nextBtn.classList.remove('opacity-50');
                nextBtn.style.cursor = 'pointer';
            }
        }

        // Initialize button styles
        updateButtonStyles();

        // Auto-play next video when current one ends (optional enhancement)
        // This would require YouTube API integration for more advanced control
    </script>
@endsection
