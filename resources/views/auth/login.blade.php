@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Or
                <a href="{{ route('register') }}" class="text-[#F53003] hover:text-[#d42a00] font-medium">
                    create a new account
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
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
                                {{ $errors->first() }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-400">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4">
                <!-- Username Field -->
                <div>
                    <label for="username" class="sr-only">Username</label>
                    <input id="username" name="username" type="text" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('username') border-[#F53003] dark:border-[#F61500] @enderror"
                           placeholder="Username"
                           value="{{ old('username') }}">
                    @error('username')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required
                           class="relative block w-full px-3 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] placeholder-[#706f6c] dark:placeholder-[#A1A09A] text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] focus:z-10 sm:text-sm @error('password') border-[#F53003] dark:border-[#F61500] @enderror"
                           placeholder="Password">
                    @error('password')
                        <p class="mt-1 text-sm text-[#F53003] dark:text-[#F61500]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-[#F53003] focus:ring-[#F53003] border-[#e3e3e0] dark:border-[#3E3E3A] rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="text-[#F53003] hover:text-[#d42a00] font-medium">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#F53003] hover:bg-[#d42a00] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F53003] transition duration-300">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
