@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container py-4" style="max-width: 1024px;">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="h4 fw-semibold mb-1">Edit Profile</h1>
                <p class="small text-muted mb-0">Update your profile information and password.</p>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-start mb-4">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="text-danger me-3 mt-1 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <div>
                            <h6 class="small fw-medium mb-2 text-danger">There were errors with your submission:</h6>
                            <ul class="small mb-0 text-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h5 class="fw-medium mb-3">Basic Information</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="firstname" class="form-label fw-medium">
                                    First Name
                                </label>
                                <input type="text" id="firstname" name="firstname"
                                    value="{{ old('firstname', $user->firstname) }}"
                                    class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" required>
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname" class="form-label fw-medium">
                                    Last Name
                                </label>
                                <input type="text" id="lastname" name="lastname"
                                    value="{{ old('lastname', $user->lastname) }}"
                                    class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="form-label fw-medium">
                            Username
                        </label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}"
                            class="form-control" disabled>
                        <div class="form-text">Username cannot be changed.</div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Change -->
                    <div class="border-top pt-4 mb-4">
                        <h5 class="fw-medium mb-2">Change Password</h5>
                        <p class="small text-muted mb-3">Leave blank if you don't want to change your password.</p>

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-medium">
                                Current Password
                            </label>
                            <input type="password" id="current_password" name="current_password"
                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="new_password" class="form-label fw-medium">
                                    New Password
                                </label>
                                <input type="password" id="new_password" name="new_password"
                                    class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="new_password_confirmation" class="form-label fw-medium">
                                    Confirm New Password
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3 pt-3">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-danger">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
