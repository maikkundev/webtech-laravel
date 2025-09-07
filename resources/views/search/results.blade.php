@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Search Summary -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2">
                                <i class="bi bi-search me-2"></i>
                                Search Results
                            </h4>
                            @if($playlists->total() > 0)
                                <p class="text-muted mb-0">
                                    Found {{ $playlists->total() }} playlists
                                    @if($textQuery || $userQuery || $dateFrom || $dateTo)
                                        with the following criteria:
                                    @endif
                                </p>
                            @else
                                <p class="text-muted mb-0">No results found for your search.</p>
                            @endif
                            
                            @if($textQuery || $userQuery || $dateFrom || $dateTo)
                                <div class="mt-2">
                                    @if($textQuery)
                                        <span class="badge bg-primary me-1">
                                            <i class="bi bi-text-left me-1"></i>
                                            Text: "{{ $textQuery }}"
                                        </span>
                                    @endif
                                    @if($userQuery)
                                        <span class="badge bg-info me-1">
                                            <i class="bi bi-person me-1"></i>
                                            User: "{{ $userQuery }}"
                                        </span>
                                    @endif
                                    @if($dateFrom)
                                        <span class="badge bg-success me-1">
                                            <i class="bi bi-calendar me-1"></i>
                                            From: {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }}
                                        </span>
                                    @endif
                                    @if($dateTo)
                                        <span class="badge bg-success me-1">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            To: {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('search.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i>
                                New Search
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($playlists->count() > 0)
                <!-- Results -->
                <div class="row">
                    @foreach($playlists as $playlist)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <!-- Playlist Thumbnail/Header -->
                                <div class="card-header bg-primary text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <i class="bi bi-music-note-list me-1"></i>
                                            {{ Str::limit($playlist->title, 25) }}
                                        </h6>
                                        @if($playlist->videos_count > 0)
                                            <span class="badge bg-light text-dark">
                                                {{ $playlist->videos_count }} video{{ $playlist->videos_count !== 1 ? 's' : '' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Playlist Description -->
                                    @if($playlist->description)
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($playlist->description, 100) }}
                                        </p>
                                    @endif

                                    <!-- Creator Info -->
                                    <div class="mb-3">
                                        <small class="text-muted">
                                            <i class="bi bi-person-circle me-1"></i>
                                            Creator: <strong>{{ $playlist->user->firstname }} {{ $playlist->user->lastname }}</strong> 
                                            <span class="text-primary">({{ '@' . $playlist->user->username }})</span>
                                        </small>
                                    </div>

                                    <!-- Creation Date -->
                                    <div class="mb-3">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            Created: {{ $playlist->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>

                                    <!-- Sample Videos -->
                                    @if($playlist->videos->count() > 0)
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">
                                                <i class="bi bi-play-circle me-1"></i>
                                                Content:
                                            </small>
                                            @foreach($playlist->videos->take(3) as $video)
                                                <div class="text-truncate small text-muted">
                                                    • {{ $video->title }}
                                                </div>
                                            @endforeach
                                            @if($playlist->videos->count() > 3)
                                                <small class="text-muted">
                                                    ... and {{ $playlist->videos->count() - 3 }} more
                                                </small>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('playlists.show', $playlist) }}" 
                                           class="btn btn-outline-primary btn-sm flex-fill">
                                            <i class="bi bi-eye me-1"></i>
                                            View
                                        </a>
                                        @if($playlist->videos_count > 0)
                                            <a href="{{ route('playlists.play', $playlist) }}" 
                                               class="btn btn-success btn-sm flex-fill">
                                                <i class="bi bi-play-fill me-1"></i>
                                                Play
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $playlists->links('pagination::bootstrap-4') }}
                </div>

                <!-- Results Info -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="h5 text-primary">{{ $playlists->total() }}</div>
                                <div class="text-muted">Total Results</div>
                            </div>
                            <div class="col-md-4">
                                <div class="h5 text-info">{{ $playlists->currentPage() }}</div>
                                <div class="text-muted">Current Page</div>
                            </div>
                            <div class="col-md-4">
                                <div class="h5 text-success">{{ $playlists->lastPage() }}</div>
                                <div class="text-muted">Total Pages</div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- No Results -->
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search display-1 text-muted mb-4"></i>
                        <h4 class="text-muted">No results found</h4>
                        <p class="text-muted mb-4">
                            Try adjusting your search criteria or removing some filters.
                        </p>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <h6>Tips:</h6>
                                <ul class="list-unstyled text-muted">
                                    <li>• Check the spelling of your keywords</li>
                                    <li>• Use more general search terms</li>
                                    <li>• Remove some date filters</li>
                                    <li>• Try different user search terms</li>
                                </ul>
                            </div>
                        </div>
                        
                        <a href="{{ route('search.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back to Search
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
