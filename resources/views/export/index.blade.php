@extends('layouts.app')

@section('title', 'Export Open Data')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-file-earmark-arrow-down me-2"></i>
                            Export Open Data
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>About Open Data Export:</strong>
                            This feature exports your own playlists and public playlists from users you follow in YAML format
                            while preserving user privacy through anonymization.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">{{ auth()->user()->playlists()->count() }}</h5>
                                        <p class="card-text">Your Playlists</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-success">{{ auth()->user()->following()->count() }}</h5>
                                        <p class="card-text">Users You Follow</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-info">{{ auth()->user()->videos()->count() }}</h5>
                                        <p class="card-text">Videos You Added</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">What's included in your export:</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                All your own playlists (both public and private) with titles and descriptions
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Public playlists from users you follow
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Video information (title, YouTube ID, URLs) from included playlists
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Creation timestamps for playlists and videos
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Anonymized user information (initials and hash IDs)
                            </li>
                        </ul>

                        <h5 class="mb-3">Privacy protection:</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                Usernames and emails are replaced with anonymous hash identifiers
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                Only first and last name initials are shown
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                Playlist visibility is clearly marked (public/private)
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                No sensitive personal information is included
                            </li>
                        </ul>

                        <div class="text-center">
                            <a href="{{ route('export.yaml') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-download me-2"></i>
                                Download My Data Export
                            </a>
                        </div>

                        <div class="mt-4">
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                The export file will be generated with a timestamp in the filename and downloaded
                                automatically.
                                <br>
                                <i class="bi bi-file-earmark-text me-1"></i>
                                For detailed information about the YAML format, see the
                                <a href="{{ asset('YAML_EXPORT_FORMAT.md') }}" target="_blank"
                                    class="text-decoration-none">format documentation</a>.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
