@extends('layouts.app')

@section('title', 'Playing: ' . $playlist->title)

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('playlists.show', $playlist) }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $playlist->title }}</h1>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Video Player -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                    <!-- YouTube Embed -->
                    <div class="relative pb-[56.25%] h-0">
                        <iframe id="youtube-player"
                                class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $playlist->videos->first()->youtube_id }}?autoplay=1&rel=0"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-6">
                        <h2 id="current-video-title" class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            {{ $playlist->videos->first()->title }}
                        </h2>
                        <div class="flex items-center justify-between text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            <span id="video-index">1 of {{ $playlist->videos->count() }}</span>
                            <span>Added {{ $playlist->videos->first()->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Player Controls -->
                <div class="flex items-center justify-center space-x-4 mt-6">
                    <button id="prev-btn" onclick="previousVideo()" class="p-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg hover:bg-[#f8f9fa] dark:hover:bg-[#3E3E3A] transition duration-300" disabled>
                        <svg class="w-6 h-6 text-[#706f6c] dark:text-[#A1A09A]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                        </svg>
                    </button>
                    <button id="next-btn" onclick="nextVideo()" class="p-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg hover:bg-[#f8f9fa] dark:hover:bg-[#3E3E3A] transition duration-300">
                        <svg class="w-6 h-6 text-[#706f6c] dark:text-[#A1A09A]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Playlist Queue -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                            Playlist Queue ({{ $playlist->videos->count() }})
                        </h3>
                    </div>
                    
                    <div class="max-h-96 overflow-y-auto">
                        @foreach($playlist->videos as $index => $video)
                            <div class="video-item flex items-center space-x-3 p-4 hover:bg-[#f8f9fa] dark:hover:bg-[#0a0a0a] cursor-pointer border-b border-[#e3e3e0] dark:border-[#3E3E3A] last:border-b-0 {{ $index === 0 ? 'bg-[#f8f9fa] dark:bg-[#0a0a0a] current-video' : '' }}"
                                 data-index="{{ $index }}" 
                                 data-video-id="{{ $video->youtube_id }}" 
                                 data-title="{{ $video->title }}"
                                 data-created="{{ $video->created_at->diffForHumans() }}"
                                 onclick="playVideo({{ $index }})">
                                
                                <!-- Video Index -->
                                <div class="flex-shrink-0 w-8 text-center">
                                    <span class="text-[#706f6c] dark:text-[#A1A09A] text-sm font-medium">{{ $index + 1 }}</span>
                                </div>
                                
                                <!-- Video Thumbnail -->
                                <div class="flex-shrink-0 relative">
                                    <img src="{{ $video->thumbnail_url }}" 
                                         alt="{{ $video->title }}" 
                                         class="w-16 h-12 object-cover rounded">
                                    @if($index === 0)
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Video Info -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate">
                                        {{ $video->title }}
                                    </h4>
                                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
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
const videos = @json($playlist->videos->map(function($video, $index) {
    return [
        'index' => $index,
        'youtube_id' => $video->youtube_id,
        'title' => $video->title,
        'created_at' => $video->created_at->diffForHumans()
    ];
})->values());

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
            item.classList.add('current-video', 'bg-[#f8f9fa]', 'dark:bg-[#0a0a0a]');
            // Add play icon overlay
            const thumbnail = item.querySelector('img').parentElement;
            thumbnail.classList.add('relative');
            if (!thumbnail.querySelector('.absolute')) {
                thumbnail.innerHTML += `
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                `;
            }
        } else {
            item.classList.remove('current-video', 'bg-[#f8f9fa]', 'dark:bg-[#0a0a0a]');
            // Remove play icon overlay
            const overlay = item.querySelector('.absolute');
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
        prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
    
    if (nextBtn.disabled) {
        nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

// Initialize button styles
updateButtonStyles();

// Auto-play next video when current one ends (optional enhancement)
// This would require YouTube API integration for more advanced control
</script>
@endsection
