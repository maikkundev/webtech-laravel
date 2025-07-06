@extends('layouts.app')

@section('title', 'Videos')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Videos</h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Browse and manage your video collection</p>
            </div>
            <a href="{{ route('videos.create') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                Add Video
            </a>
        </div>

        <!-- Videos Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($videos as $video)
                <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-[#f8f9fa] dark:bg-[#3E3E3A] flex items-center justify-center">
                        @if($video->thumbnail_url)
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 line-clamp-2">
                            {{ $video->title }}
                        </h3>

                        @if($video->description)
                            <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-3 line-clamp-3">
                                {{ $video->description }}
                            </p>
                        @endif

                        <div class="flex items-center justify-between text-sm">
                            <div class="text-[#706f6c] dark:text-[#A1A09A]">
                                {{ $video->duration ? $video->duration . ' min' : 'No duration' }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('videos.show', $video) }}" class="text-[#F53003] hover:text-[#d42a00] font-medium">
                                    View
                                </a>
                                <a href="{{ route('videos.edit', $video) }}" class="text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] font-medium">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="w-16 h-16 bg-[#f8f9fa] dark:bg-[#3E3E3A] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No videos yet</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Start building your video collection</p>
                    <a href="{{ route('videos.create') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Add Your First Video
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
