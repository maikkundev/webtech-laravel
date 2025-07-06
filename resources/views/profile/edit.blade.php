@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Edit Profile</h1>
            <p class="mt-2 text-sm text-[#6b6b64] dark:text-[#A8A8A3]">Update your profile information and password.</p>
        </div>

        <div class="p-6">
            @if($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-400">There were errors with your submission:</h3>
                            <ul class="mt-2 text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                First Name
                            </label>
                            <input type="text" id="firstname" name="firstname"
                                   value="{{ old('firstname', $user->firstname) }}"
                                   class="w-full px-3 py-2 border rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent {{ $errors->has('firstname') ? 'border-red-500' : 'border-[#e3e3e0] dark:border-[#3E3E3A]' }}"
                                   required>
                            @error('firstname')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="lastname" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Last Name
                            </label>
                            <input type="text" id="lastname" name="lastname"
                                   value="{{ old('lastname', $user->lastname) }}"
                                   class="w-full px-3 py-2 border rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent {{ $errors->has('lastname') ? 'border-red-500' : 'border-[#e3e3e0] dark:border-[#3E3E3A]' }}"
                                   required>
                            @error('lastname')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Username
                    </label>
                    <input type="text" id="username" name="username"
                           value="{{ $user->username }}"
                           class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md bg-[#f9f9f8] dark:bg-[#0a0a0a] text-[#6b6b64] dark:text-[#A8A8A3] cursor-not-allowed"
                           disabled>
                    <p class="mt-1 text-sm text-[#6b6b64] dark:text-[#A8A8A3]">Username cannot be changed.</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Email
                    </label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent {{ $errors->has('email') ? 'border-red-500' : 'border-[#e3e3e0] dark:border-[#3E3E3A]' }}"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Change -->
                <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-6">
                    <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Change Password</h3>
                    <p class="text-sm text-[#6b6b64] dark:text-[#A8A8A3] mb-4">Leave blank if you don't want to change your password.</p>

                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Current Password
                            </label>
                            <input type="password" id="current_password" name="current_password"
                                   class="w-full px-3 py-2 border rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent {{ $errors->has('current_password') ? 'border-red-500' : 'border-[#e3e3e0] dark:border-[#3E3E3A]' }}">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                    New Password
                                </label>
                                <input type="password" id="new_password" name="new_password"
                                       class="w-full px-3 py-2 border rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent {{ $errors->has('new_password') ? 'border-red-500' : 'border-[#e3e3e0] dark:border-[#3E3E3A]' }}">
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                    Confirm New Password
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                       class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 text-sm font-medium text-[#6b6b64] dark:text-[#A8A8A3] bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md hover:bg-[#f9f9f8] dark:hover:bg-[#0a0a0a] transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#F53003] hover:bg-[#d42a00] rounded-md transition-colors">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
