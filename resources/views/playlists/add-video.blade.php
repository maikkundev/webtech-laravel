@extends('layouts.app')

@section('title', 'Add Videos to ' . $playlist->title)

@section('content')
    <div class="min-vh-100 py-4" style="background-color: #FDFDFC;">
        <div class="container" style="max-width: 1024px;">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('playlists.show', $playlist) }}" class="text-decoration-none text-muted me-3"
                        onmouseover="this.style.color='#F53003'" onmouseout="this.style.color='#6c757d'">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="h3 fw-bold mb-0" style="color: #1b1b18;">Add Videos</h1>
                        <p class="text-muted mb-0">to "{{ $playlist->title }}"</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Search YouTube -->
                <div class="col-12">
                    <div class="card border h-100" style="background-color: white; border-color: #e3e3e0;">
                        <div class="card-body">
                            <h2 class="h5 fw-semibold mb-3" style="color: #1b1b18;">Search YouTube</h2>

                            <div class="mb-3">
                                <div class="position-relative">
                                    <input type="text" id="search_query" placeholder="Search for videos..."
                                        class="form-control pe-5" style="border-color: #e3e3e0; color: #1b1b18;"
                                        onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                        onblur="this.style.borderColor='#e3e3e0'; this.style.boxShadow='none'">
                                    <button type="button" onclick="searchVideos()"
                                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted"
                                        style="margin-right: 8px;" onmouseover="this.style.color='#F53003'"
                                        onmouseout="this.style.color='#6c757d'">
                                        <svg width="20" height="20" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
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
            <div class="d-flex align-items-center gap-3 p-2 rounded border mb-2"
                 style="background-color: #fefefe; border-color: #e3e3e0;">
                <img src="${video.thumbnail}" alt="${video.title}" class="rounded" style="width: 64px; height: 48px; object-fit: cover;">
                <div class="flex-grow-1" style="min-width: 0;">
                    <h4 class="small fw-medium mb-0 text-truncate" style="color: #1b1b18;">${video.title}</h4>
                    <p class="small text-muted mb-0">${video.channel}</p>
                </div>
                <button type="button"
                        onclick="addVideoToPlaylist('${video.id}', '${video.title.replace(/'/g, "\\'")}')"
                        class="btn btn-sm text-white fw-semibold px-3"
                        style="background-color: #F53003; border-color: #F53003;"
                        onmouseover="this.style.backgroundColor='#d42a00'"
                        onmouseout="this.style.backgroundColor='#F53003'">
                    Add to Playlist
                </button>
            </div>
        `).join('');
            } catch (error) {
                resultsContainer.innerHTML = '<p class="text-danger text-center py-3">Error searching videos</p>';
            }
        }

        function addVideoToPlaylist(videoId, title) {
            // Create a form and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('playlists.store-video', $playlist) }}';

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Add video ID
            const videoIdInput = document.createElement('input');
            videoIdInput.type = 'hidden';
            videoIdInput.name = 'youtube_id';
            videoIdInput.value = videoId;
            form.appendChild(videoIdInput);

            // Add video title
            const titleInput = document.createElement('input');
            titleInput.type = 'hidden';
            titleInput.name = 'title';
            titleInput.value = title;
            form.appendChild(titleInput);

            // Add YouTube URL
            const urlInput = document.createElement('input');
            urlInput.type = 'hidden';
            urlInput.name = 'youtube_url';
            urlInput.value = `https://www.youtube.com/watch?v=${videoId}`;
            form.appendChild(urlInput);

            // Submit the form
            document.body.appendChild(form);
            form.submit();
        }

        // Allow search on Enter key
        document.getElementById('search_query').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchVideos();
            }
        });
    </script>
@endsection
