@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container py-4" style="max-width: 1024px;">
        <div class="card border shadow-sm" style="background-color: white; border-color: #e3e3e0;">
            <div class="card-header border-bottom" style="border-color: #e3e3e0; background-color: white;">
                <h1 class="h4 fw-semibold mb-1" style="color: #1b1b18;">Edit Profile</h1>
                <p class="small text-muted mb-0">Update your profile information and password.</p>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger border d-flex align-items-start mb-4"
                         style="background-color: #fef2f2; border-color: #fecaca;">
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
                        <h5 class="fw-medium mb-3" style="color: #1b1b18;">Basic Information</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="firstname" class="form-label fw-medium" style="color: #1b1b18;">
                                    First Name
                                </label>
                                <input type="text" id="firstname" name="firstname"
                                       value="{{ old('firstname', $user->firstname) }}"
                                       class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                                       style="border-color: {{ $errors->has('firstname') ? '#dc3545' : '#e3e3e0' }}; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='{{ $errors->has('firstname') ? '#dc3545' : '#e3e3e0' }}'; this.style.boxShadow='none'"
                                       required>
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname" class="form-label fw-medium" style="color: #1b1b18;">
                                    Last Name
                                </label>
                                <input type="text" id="lastname" name="lastname"
                                       value="{{ old('lastname', $user->lastname) }}"
                                       class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                                       style="border-color: {{ $errors->has('lastname') ? '#dc3545' : '#e3e3e0' }}; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='{{ $errors->has('lastname') ? '#dc3545' : '#e3e3e0' }}'; this.style.boxShadow='none'"
                                       required>
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="form-label fw-medium" style="color: #1b1b18;">
                            Username
                        </label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}"
                               class="form-control"
                               style="background-color: #f8f9fa; border-color: #e3e3e0; color: #6c757d;"
                               disabled>
                        <div class="form-text">Username cannot be changed.</div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium" style="color: #1b1b18;">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               style="border-color: {{ $errors->has('email') ? '#dc3545' : '#e3e3e0' }}; color: #1b1b18;"
                               onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                               onblur="this.style.borderColor='{{ $errors->has('email') ? '#dc3545' : '#e3e3e0' }}'; this.style.boxShadow='none'"
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Change -->
                    <div class="border-top pt-4 mb-4" style="border-color: #e3e3e0;">
                        <h5 class="fw-medium mb-2" style="color: #1b1b18;">Change Password</h5>
                        <p class="small text-muted mb-3">Leave blank if you don't want to change your password.</p>

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-medium" style="color: #1b1b18;">
                                Current Password
                            </label>
                            <input type="password" id="current_password" name="current_password"
                                   class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                   style="border-color: {{ $errors->has('current_password') ? '#dc3545' : '#e3e3e0' }}; color: #1b1b18;"
                                   onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                   onblur="this.style.borderColor='{{ $errors->has('current_password') ? '#dc3545' : '#e3e3e0' }}'; this.style.boxShadow='none'">
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="new_password" class="form-label fw-medium" style="color: #1b1b18;">
                                    New Password
                                </label>
                                <input type="password" id="new_password" name="new_password"
                                       class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                       style="border-color: {{ $errors->has('new_password') ? '#dc3545' : '#e3e3e0' }}; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='{{ $errors->has('new_password') ? '#dc3545' : '#e3e3e0' }}'; this.style.boxShadow='none'">
                                @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="new_password_confirmation" class="form-label fw-medium"
                                       style="color: #1b1b18;">
                                    Confirm New Password
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                       class="form-control" style="border-color: #e3e3e0; color: #1b1b18;"
                                       onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 0.2rem rgba(245, 48, 3, 0.25)'"
                                       onblur="this.style.borderColor='#e3e3e0'; this.style.boxShadow='none'">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3 pt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary"
                           style="border-color: #e3e3e0; color: #6c757d;">
                            Cancel
                        </a>
                        <button type="submit" class="btn text-white"
                                style="background-color: #F53003; border-color: #F53003;"
                                onmouseover="this.style.backgroundColor='#d42a00'"
                                onmouseout="this.style.backgroundColor='#F53003'">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
