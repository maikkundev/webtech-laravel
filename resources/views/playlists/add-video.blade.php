@extends('layouts.app')

@section('title', 'Add Videos to ' . $playlist->title)

@section('content')
<div class="min-vh-100 py-4" style="background-color: #FDFDFC;">
    <div class="container" style="max-width: 1024px;">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('playlists.show', $playlist) }}" class="text-decoration-none text-muted me-3"
                   onmouseover="this.style.color='#F53003'"
                   onmouseout="this.style.color='#6c757d'">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="h3 fw-bold mb-0" style="color: #1b1b18;">Add Videos</h1>
                    <p class="text-muted mb-0">to "{{ $playlist->title }}"</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Add by URL -->
            <div class="col-12 col-lg-6">
                <div class="card border h-100" style="background-color: white; border-color: #e3e3e0;">
                    <div class="card-body">
                        <h2 class="h5 fw-semibold mb-3" style="color: #1b1b18;">Add by YouTube URL</h2>

                        <form action="{{ route('playlists.store-video', $playlist) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="youtube_url" class="form-label fw-medium" style="color: #1b1b18;">
                                    YouTube URL
                                </label>
                                <input type="url"
                                       id="youtube_url"
                                       name="youtube_url"
                                       placeholder="https://www.youtube.com/watch?v=..."
                                       value="{{ old('youtube_url') }}"
                                       class="form-control"
                                       style="border-color: #e3e3e0; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='#e3e3e0'; this.style.boxShadow='none'">
                                @error('youtube_url')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="video_title" class="form-label fw-medium" style="color: #1b1b18;">
                                    Video Title
                                </label>
                                <input type="text"
                                       id="video_title"
                                       name="title"
                                       placeholder="Enter video title"
                                       value="{{ old('title') }}"
                                       required
                                       class="form-control"
                                       style="border-color: #e3e3e0; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='#e3e3e0'; this.style.boxShadow='none'">
                                @error('title')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" id="youtube_id" name="youtube_id" value="{{ old('youtube_id') }}">

                            <button type="submit"
                                    class="btn w-100 text-white fw-semibold"
                                    style="background-color: #F53003; border-color: #F53003;"
                                    onmouseover="this.style.backgroundColor='#d42a00'"
                                    onmouseout="this.style.backgroundColor='#F53003'">
                                Add Video to Playlist
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search YouTube -->
            <div class="col-12 col-lg-6">
                <div class="card border h-100" style="background-color: white; border-color: #e3e3e0;">
                    <div class="card-body">
                        <h2 class="h5 fw-semibold mb-3" style="color: #1b1b18;">Search YouTube</h2>

                        <div class="mb-3">
                            <div class="position-relative">
                                <input type="text"
                                       id="search_query"
                                       placeholder="Search for videos..."
                                       class="form-control pe-5"
                                       style="border-color: #e3e3e0; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='#e3e3e0'; this.style.boxShadow='none'">
                                <button type="button"
                                        onclick="searchVideos()"
                                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted"
                                        style="margin-right: 8px;"
                                        onmouseover="this.style.color='#F53003'"
                                        onmouseout="this.style.color='#6c757d'">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Search Results -->
                        <div id="search_results" class="overflow-auto" style="max-height: 400px;">
                            <p class="text-muted text-center py-4">Search for videos to add to your playlist</p>
                        </div>
                    </div>
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
    resultsContainer.innerHTML = '<p class="text-muted text-center py-3">Searching...</p>';

    try {
        const response = await fetch(`/search/videos?q=${encodeURIComponent(query)}`);
        const videos = await response.json();

        if (videos.length === 0) {
            resultsContainer.innerHTML = '<p class="text-muted text-center py-3">No videos found</p>';
            return;
        }

        resultsContainer.innerHTML = videos.map(video => `
            <div class="d-flex align-items-center gap-3 p-2 rounded" 
                 style="cursor: pointer;" 
                 onclick="selectVideo('${video.id}', '${video.title.replace(/'/g, "\\'")}')"
                 onmouseover="this.style.backgroundColor='#f8f9fa'"
                 onmouseout="this.style.backgroundColor='transparent'">
                <img src="${video.thumbnail}" alt="${video.title}" class="rounded" style="width: 64px; height: 48px; object-fit: cover;">
                <div class="flex-grow-1" style="min-width: 0;">
                    <h4 class="small fw-medium mb-0 text-truncate" style="color: #1b1b18;">${video.title}</h4>
                    <p class="small text-muted mb-0">${video.channel}</p>
                </div>
                <svg width="20" height="20" fill="#F53003" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
        `).join('');
    } catch (error) {
        resultsContainer.innerHTML = '<p class="text-danger text-center py-3">Error searching videos</p>';
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
