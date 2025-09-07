@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5 px-3">
        <div class="w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold">
                    Sign in to your account
                </h2>
                <p class="text-muted small mt-2">
                    Or
                    <a href="{{ route('register') }}" class="text-decoration-none fw-medium text-danger">
                        create a new account
                    </a>
                </p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Display Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger border d-flex align-items-start">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="text-danger me-2 mt-1 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <div>
                            <small class="fw-medium text-danger">
                                {{ $errors->first() }}
                            </small>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success border d-flex align-items-start">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="text-success me-2 mt-1 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <small class="fw-medium text-success">
                                {{ session('success') }}
                            </small>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="visually-hidden">Username</label>
                        <input id="username" name="username" type="text" required
                            class="form-control py-3 @error('username') is-invalid @enderror" placeholder="Username"
                            value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="visually-hidden">Password</label>
                        <input id="password" name="password" type="password" required
                            class="form-control py-3 @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                        <input id="remember_me" name="remember" type="checkbox" class="form-check-input">
                        <label for="remember_me" class="form-check-label small text-muted">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="#" class="text-decoration-none small fw-medium text-danger">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-danger btn-lg position-relative">
                        <span class="position-absolute start-0 top-50 translate-middle-y ps-3">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
