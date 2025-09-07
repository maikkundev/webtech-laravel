@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-search me-2"></i>
                        Search Playlists
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('search.results') }}" method="GET" class="row g-3">
                        
                        <!-- Text Search -->
                        <div class="col-md-6">
                            <label for="text_query" class="form-label">
                                <i class="bi bi-text-left me-1"></i>
                                Text Search
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="text_query" 
                                   name="text_query"
                                   placeholder="Search in playlist titles or content..."
                                   value="{{ request('text_query') }}">
                            <div class="form-text">Search in playlist titles, descriptions, and video titles</div>
                        </div>

                        <!-- User Search -->
                        <div class="col-md-6">
                            <label for="user_query" class="form-label">
                                <i class="bi bi-person me-1"></i>
                                User Search
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="user_query" 
                                   name="user_query"
                                   placeholder="First name, last name, username or email..."
                                   value="{{ request('user_query') }}">
                            <div class="form-text">Search by playlist creator details</div>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-4">
                            <label for="date_from" class="form-label">
                                <i class="bi bi-calendar me-1"></i>
                                From Date
                            </label>
                            <input type="date" 
                                   class="form-control" 
                                   id="date_from" 
                                   name="date_from"
                                   value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-4">
                            <label for="date_to" class="form-label">
                                <i class="bi bi-calendar-check me-1"></i>
                                To Date
                            </label>
                            <input type="date" 
                                   class="form-control" 
                                   id="date_to" 
                                   name="date_to"
                                   value="{{ request('date_to') }}">
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i>
                                Search
                            </button>
                        </div>

                        <!-- Clear Filters -->
                        <div class="col-12">
                            <a href="{{ route('search.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Tips -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-lightbulb me-1"></i>
                        Search Tips
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle text-success me-1"></i> Use keywords for better results</li>
                                <li><i class="bi bi-check-circle text-success me-1"></i> Text search looks in titles and content</li>
                                <li><i class="bi bi-check-circle text-success me-1"></i> Dates refer to playlist creation date</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="bi bi-info-circle text-info me-1"></i> You can combine multiple criteria</li>
                                <li><i class="bi bi-info-circle text-info me-1"></i> Only public playlists are shown</li>
                                <li><i class="bi bi-info-circle text-info me-1"></i> Results are sorted chronologically</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
