@extends('layouts.app')

@section('title', 'Create Playlist')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('playlists.index') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Create New Playlist</h1>
            </div>
            <p class="text-[#706f6c] dark:text-[#A1A09A]">Create a new playlist to organize your favorite videos</p>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-8">
            <form action="{{ route('playlists.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Playlist Title *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}"
                           maxlength="100"
                           required
                           class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Privacy Setting -->
                <div class="mb-8">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="is_public" 
                               name="is_public" 
                               value="1"
                               {{ old('is_public') ? 'checked' : '' }}
                               class="w-4 h-4 text-[#F53003] bg-white dark:bg-[#0a0a0a] border-[#e3e3e0] dark:border-[#3E3E3A] rounded focus:ring-[#F53003] focus:ring-2">
                        <label for="is_public" class="ml-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                            Make this playlist public
                        </label>
                    </div>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        Public playlists can be viewed by other users
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('playlists.index') }}" 
                       class="px-6 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#706f6c] dark:text-[#A1A09A] rounded-lg hover:bg-[#f8f9fa] dark:hover:bg-[#3E3E3A] transition duration-300">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-[#F53003] hover:bg-[#d42a00] text-white rounded-lg font-semibold transition duration-300">
                        Create Playlist
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
