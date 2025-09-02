@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5 px-3"
         style="background-color: #FDFDFC;">
        <div class="w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold" style="color: #1b1b18;">
                    Create your account
                </h2>
                <p class="text-muted small mt-2">
                    Or
                    <a href="{{ route('login') }}" class="text-decoration-none fw-medium" style="color: #F53003;">
                        sign in to existing account
                    </a>
                </p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Display Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger border d-flex align-items-start"
                         style="background-color: #fff2f2; border-color: #F53003;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             style="color: #F53003;" class="me-2 mt-1 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <div>
                            <small class="fw-medium" style="color: #F53003;">
                                Please fix the following errors:
                            </small>
                            <ul class="mt-1 mb-0 small" style="color: #F53003;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <!-- Name Fields -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label for="firstname" class="visually-hidden">First Name</label>
                            <input id="firstname" name="firstname" type="text" required
                                   class="form-control py-2 @error('firstname') is-invalid @enderror"
                                   placeholder="First Name"
                                   value="{{ old('firstname') }}" style="border-color: #e3e3e0; color: #1b1b18;">
                            @error('firstname')
                            <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="lastname" class="visually-hidden">Last Name</label>
                            <input id="lastname" name="lastname" type="text" required
                                   class="form-control py-2 @error('lastname') is-invalid @enderror"
                                   placeholder="Last Name"
                                   value="{{ old('lastname') }}" style="border-color: #e3e3e0; color: #1b1b18;">
                            @error('lastname')
                            <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="visually-hidden">Username</label>
                        <input id="username" name="username" type="text" required
                               class="form-control py-2 @error('username') is-invalid @enderror" placeholder="Username"
                               value="{{ old('username') }}" style="border-color: #e3e3e0; color: #1b1b18;">
                        @error('username')
                        <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="visually-hidden">Email</label>
                        <input id="email" name="email" type="email" required
                               class="form-control py-2 @error('email') is-invalid @enderror"
                               placeholder="Email address"
                               value="{{ old('email') }}" style="border-color: #e3e3e0; color: #1b1b18;">
                        @error('email')
                        <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="visually-hidden">Password</label>
                        <input id="password" name="password" type="password" required
                               class="form-control py-2 @error('password') is-invalid @enderror" placeholder="Password"
                               style="border-color: #e3e3e0; color: #1b1b18;">
                        @error('password')
                        <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="visually-hidden">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="form-control py-2 @error('password_confirmation') is-invalid @enderror"
                               placeholder="Confirm Password" style="border-color: #e3e3e0; color: #1b1b18;">
                        @error('password_confirmation')
                        <div class="invalid-feedback small" style="color: #F53003;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-lg text-white position-relative"
                            style="background-color: #F53003; border-color: #F53003;">
                        <span class="position-absolute start-0 top-50 translate-middle-y ps-3">
                            <svg width="20" height="20" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
