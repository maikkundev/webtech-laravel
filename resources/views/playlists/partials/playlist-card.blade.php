<div class="card h-100 border shadow-sm" style="background-color: white; border-color: #e3e3e0;">
    <!-- Playlist Thumbnail -->
    <div class="position-relative" style="height: 200px; background: linear-gradient(135deg, #F53003, #d42a00);">
        @if($playlist->videos->count() > 0)
            <img src="{{ $playlist->videos->first()->thumbnail_url }}"
                 alt="{{ $playlist->title }}"
                 class="w-100 h-100" style="object-fit: cover;">
        @endif
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white" 
             style="background-color: rgba(0,0,0,0.4);">
            <div class="text-center">
                <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24" class="mb-2">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <span class="small fw-medium">{{ $playlist->videos_count ?? 0 }} videos</span>
            </div>
        </div>
        @if($playlist->is_public)
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-success">Public</span>
            </div>
        @else
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-secondary">Private</span>
            </div>
        @endif
    </div>

    <div class="card-body">
        <div class="mb-3">
            <h3 class="h5 fw-semibold mb-2" style="color: #1b1b18;">
                {{ $playlist->title }}
            </h3>

            @if($showOwner)
                <p class="small text-muted mb-2">
                    by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}
                </p>
            @endif

            @if($playlist->description)
                <p class="text-muted small text-truncate" style="max-height: 2.4em; overflow: hidden;">
                    {{ $playlist->description }}
                </p>
            @endif
        </div>

        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                {{ $playlist->created_at->diffForHumans() }}
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('playlists.show', $playlist) }}"
                   class="text-decoration-none fw-medium"
                   style="color: #F53003;"
                   onmouseover="this.style.color='#d42a00'"
                   onmouseout="this.style.color='#F53003'">
                    View
                </a>
                @if($playlist->videos_count > 0)
                    <a href="{{ route('playlists.play', $playlist) }}"
                       class="text-decoration-none fw-medium"
                       style="color: #F53003;"
                       onmouseover="this.style.color='#d42a00'"
                       onmouseout="this.style.color='#F53003'">
                        Play
                    </a>
                @endif
                @if(!$showOwner)
                    <a href="{{ route('playlists.edit', $playlist) }}"
                       class="text-decoration-none fw-medium text-muted">
                        Edit
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
