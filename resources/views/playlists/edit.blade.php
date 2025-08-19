@extends('layouts.app')

@section('title', 'Edit Playlist')

@section('content')
    <div class="min-vh-100 py-5" style="background-color: #FDFDFC;">
        <div class="container" style="max-width: 600px;">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('playlists.show', $playlist) }}" class="text-muted me-3 text-decoration-none"
                       style="color: #706f6c !important;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <h1 class="display-6 fw-bold mb-0" style="color: #1b1b18;">Edit Playlist</h1>
                </div>
                <p class="text-muted" style="color: #706f6c;">Update your playlist information</p>
            </div>

            <!-- Form -->
            <div class="card border p-4" style="background-color: white; border-color: #e3e3e0;">
                <form action="{{ route('playlists.update', $playlist) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label small fw-medium" style="color: #1b1b18;">
                            Playlist Title *
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $playlist->title) }}"
                               maxlength="100" required class="form-control py-3"
                               style="border-color: #e3e3e0; color: #1b1b18;">
                        @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label small fw-medium" style="color: #1b1b18;">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="form-control py-3"
                                  style="border-color: #e3e3e0; color: #1b1b18;">{{ old('description', $playlist->description) }}</textarea>
                        @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Privacy Setting -->
                    <div class="mb-5">
                        <div class="form-check">
                            <input type="checkbox" id="is_public" name="is_public" value="1"
                                   {{ old('is_public', $playlist->is_public) ? 'checked' : '' }} class="form-check-input">
                            <label for="is_public" class="form-check-label small" style="color: #1b1b18;">
                                Make this playlist public
                            </label>
                        </div>
                        <small class="text-muted">
                            Public playlists can be viewed by other users
                        </small>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button"
                                    onclick="if(confirm('Are you sure you want to delete this playlist? This action cannot be undone.')) document.getElementById('delete-form').submit();"
                                    class="btn btn-danger">
                                Delete Playlist
                            </button>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('playlists.show', $playlist) }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn text-white"
                                    style="background-color: #F53003; border-color: #F53003;">
                                Update Playlist
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Hidden delete form -->
                <form id="delete-form" action="{{ route('playlists.destroy', $playlist) }}" method="POST"
                      class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
