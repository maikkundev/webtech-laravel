@extends('layouts.app')

@section('title', 'Add Videos to ' . $playlist->title)

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('playlists.show', $playlist) }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Add Videos</h1>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">to "{{ $playlist->title }}"</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Add by URL -->
            <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
                <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Add by YouTube URL</h2>
                
                <form action="{{ route('playlists.store-video', $playlist) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="youtube_url" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            YouTube URL
                        </label>
                        <input type="url" 
                               id="youtube_url" 
                               name="youtube_url" 
                               placeholder="https://www.youtube.com/watch?v=..."
                               value="{{ old('youtube_url') }}"
                               class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
                        @error('youtube_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="video_title" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Video Title
                        </label>
                        <input type="text" 
                               id="video_title" 
                               name="title" 
                               placeholder="Enter video title"
                               value="{{ old('title') }}"
                               required
                               class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" id="youtube_id" name="youtube_id" value="{{ old('youtube_id') }}">

                    <button type="submit" 
                            class="w-full bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Add Video to Playlist
                    </button>
                </form>
            </div>

            <!-- Search YouTube -->
            <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
                <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Search YouTube</h2>
                
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" 
                               id="search_query" 
                               placeholder="Search for videos..."
                               class="w-full px-4 py-3 pr-12 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
                        <button type="button" 
                                onclick="searchVideos()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Search Results -->
                <div id="search_results" class="space-y-3 max-h-96 overflow-y-auto">
                    <p class="text-[#706f6c] dark:text-[#A1A09A] text-center py-8">Search for videos to add to your playlist</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Extract YouTube ID from URL
document.getElementById('youtube_url').addEventListener('input', function() {
    const url = this.value;
    const videoId = extractYouTubeId(url);
    document.getElementById('youtube_id').value = videoId || '';
});

function extractYouTubeId(url) {
    const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
    const match = url.match(regex);
    return match ? match[1] : null;
}

// Search videos function
async function searchVideos() {
    const query = document.getElementById('search_query').value;
    if (!query.trim()) return;

    const resultsContainer = document.getElementById('search_results');
    resultsContainer.innerHTML = '<p class="text-[#706f6c] dark:text-[#A1A09A] text-center py-4">Searching...</p>';

    try {
        const response = await fetch(`/search/videos?q=${encodeURIComponent(query)}`);
        const videos = await response.json();
        
        if (videos.length === 0) {
            resultsContainer.innerHTML = '<p class="text-[#706f6c] dark:text-[#A1A09A] text-center py-4">No videos found</p>';
            return;
        }

        resultsContainer.innerHTML = videos.map(video => `
            <div class="flex items-center space-x-3 p-3 hover:bg-[#f8f9fa] dark:hover:bg-[#0a0a0a] rounded-lg cursor-pointer" onclick="selectVideo('${video.id}', '${video.title.replace(/'/g, "\\'")}')">
                <img src="${video.thumbnail}" alt="${video.title}" class="w-16 h-12 object-cover rounded">
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate">${video.title}</h4>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">${video.channel}</p>
                </div>
                <svg class="w-5 h-5 text-[#F53003]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
        `).join('');
    } catch (error) {
        resultsContainer.innerHTML = '<p class="text-red-500 text-center py-4">Error searching videos</p>';
    }
}

function selectVideo(videoId, title) {
    document.getElementById('youtube_id').value = videoId;
    document.getElementById('video_title').value = title;
    document.getElementById('youtube_url').value = `https://www.youtube.com/watch?v=${videoId}`;
}

// Allow search on Enter key
document.getElementById('search_query').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchVideos();
    }
});
</script>
@endsection
