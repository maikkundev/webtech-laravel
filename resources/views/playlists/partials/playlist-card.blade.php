<div class="card h-100 border shadow-sm" style="border-color: #e3e3e0;">
    <!-- Playlist Thumbnail -->
    <div class="position-relative playlist-thumbnail" style="height: 200px;">
        @if ($playlist->videos->count() > 0)
            <img src="{{ $playlist->videos->first()->thumbnail_url }}" alt="{{ $playlist->title }}" class="w-100 h-100"
                 style="object-fit: cover;">
            <a href="{{ route('playlists.play', $playlist) }}"
               class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-decoration-none playlist-play-overlay">
                <div class="text-center">
                    <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24" class="mb-2">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
            </a>
        @endif
    </div>

    <div class="card-body">
        <div class="mb-3">
            <h3 class="h5 fw-semibold mb-2 d-flex justify-content-between align-items-center ">
                {{ $playlist->title }}
                @if ($playlist->is_public)
                    <span class="badge bg-success">Public</span>
                @else
                    <span class="badge bg-secondary">Private</span>
                @endif
            </h3>
            @if ($showOwner)
                <p class="small text-muted mb-2">
                    by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}
                </p>
            @endif

            @if ($playlist->description)
                <p class="text-muted small text-truncate" style="max-height: 2.4em; overflow: hidden;">
                    {{ $playlist->description }}
                </p>
            @endif
            <span class="small fw-medium">{{ $playlist->videos_count ?? 0 }} videos</span>
        </div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                {{ $playlist->created_at->diffForHumans() }}
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('playlists.show', $playlist) }}" class="text-decoration-none fw-medium"
                   onmouseover="this.style.color='#d42a00'" style="color: #F53003;"
                   onmouseout="this.style.color='#F53003'">
                    View
                </a>
                @if ($playlist->videos_count > 0)
                    <a href="{{ route('playlists.play', $playlist) }}" class="text-decoration-none fw-medium"
                       style="color: #F53003;" onmouseover="this.style.color='#d42a00'"
                       onmouseout="this.style.color='#F53003'">
                        Play
                    </a>
                @endif
                @if (!$showOwner)
                    <a href="{{ route('playlists.edit', $playlist) }}" onmouseover="this.style.color='#d42a00'"
                       style="color: #F53003;" onmouseout="this.style.color='#F53003'"
                       class="text-decoration-none fw-medium">
                        Edit
                    </a>
                @endif
            </div>
        </div>
        @if (isset($showFollowButton) && $showFollowButton && auth()->check() && isset($playlist->user) && auth()->id() !== $playlist->user->id)
            @php($isFollowing = auth()->user()->isFollowing($playlist->user))
            <div class="mt-2 text-end">
                @if ($isFollowing)
                    <form action="{{ route('users.unfollow', $playlist->user) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('users.follow', $playlist->user) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm text-white" style="background-color: #F53003; border-color: #F53003;"
                                onmouseover="this.style.backgroundColor='#d42a00'" onmouseout="this.style.backgroundColor='#F53003'">
                            Follow
                        </button>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>
