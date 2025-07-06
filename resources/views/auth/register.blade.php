@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                Create your account
            </h2>
            <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Or
                <a href="{{ route('login') }}" class="text-[#F53003] hover:text-[#d42a00] font-medium">
                    sign in to existing account
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="bg-[#fff2f2] dark:bg-[#1D0002] border border-[#F53003] dark:border-[#F61500] rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-[#F53003] dark:text-[#F61500] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-[#F53003] dark:text-[#F61500]">
                                Please fix the following errors:
                            </h3>
                            <ul class="mt-2 text-sm text-[#F53003] dark:text-[#F61500] list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4">
                <!-- Name Fields -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstname" class="sr-only">First Name</label>
                        <input id="firstname" name="firstname" type="text" required
                               class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('firstname') border-red-500 @enderror"
                               placeholder="First Name"
                               value="{{ old('firstname') }}">
                        @error('firstname')
                            <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lastname" class="sr-only">Last Name</label>
                        <input id="lastname" name="lastname" type="text" required
                               class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('lastname') border-red-500 @enderror"
                               placeholder="Last Name"
                               value="{{ old('lastname') }}">
                        @error('lastname')
                            <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Username Field -->
                <div>
                    <label for="username" class="sr-only">Username</label>
                    <input id="username" name="username" type="text" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('username') border-red-500 @enderror"
                           placeholder="Username"
                           value="{{ old('username') }}">
                    @error('username')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('email') border-red-500 @enderror"
                           placeholder="Email address"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('password') border-red-500 @enderror"
                           placeholder="Password">
                    @error('password')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('password_confirmation') border-red-500 @enderror"
                           placeholder="Confirm Password">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#F53003] hover:bg-[#d42a00] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F53003] transition duration-300">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </span>
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
