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
                            This feature exports all playlists (both public and private) and their videos in YAML format
                            while preserving user privacy through anonymization.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">{{ $stats['total_public_playlists'] }}</h5>
                                        <p class="card-text">Public Playlists</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-warning">{{ $stats['total_private_playlists'] }}</h5>
                                        <p class="card-text">Private Playlists</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-success">{{ $stats['total_videos'] }}</h5>
                                        <p class="card-text">Total Videos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-info">{{ $stats['total_users_with_content'] }}</h5>
                                        <p class="card-text">Contributing Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">What's included in the export:</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                All playlists (both public and private) with titles and descriptions
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Playlist visibility status (public/private) for each playlist
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Video information (title, YouTube ID, URLs)
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
                                Download YAML Export
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
