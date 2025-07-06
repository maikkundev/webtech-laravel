@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a]">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#F53003] to-[#d42a00] text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Welcome to {{ config('app.name', 'WebTech Laravel') }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Manage your video playlists and content with ease
            </p>
            <div class="space-x-4">
                <a href="{{ route('playlists.index') }}" class="bg-white text-[#F53003] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Browse Playlists
                </a>
                <a href="{{ route('videos.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#F53003] transition duration-300">
                    View Videos
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white dark:bg-[#161615]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">
                    Features
                </h2>
                <p class="text-xl text-[#706f6c] dark:text-[#A1A09A]">
                    Everything you need to manage your video content
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <div class="w-16 h-16 bg-[#F53003] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12 5.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Video Management</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Organize and manage your video collection with powerful tools</p>
                </div>

                <div class="text-center p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <div class="w-16 h-16 bg-[#F53003] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Playlist Creation</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Create custom playlists to organize your content</p>
                </div>

                <div class="text-center p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <div class="w-16 h-16 bg-[#F53003] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Fast Performance</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Built with Laravel for optimal speed and performance</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
