@extends('layouts.app')

@section('title', 'All Videos')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">All Videos</h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Browse all videos from playlists</p>
            </div>
        </div>

        <!-- Videos Grid -->
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Video Thumbnail -->
                        <div class="relative">
                            <img src="{{ $video->thumbnail_url }}" 
                                 alt="{{ $video->title }}" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-40 flex items-center justify-center transition duration-300 group">
                                <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" 
                                   target="_blank"
                                   class="opacity-0 group-hover:opacity-100 bg-[#F53003] text-white p-3 rounded-full transition duration-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 line-clamp-2">
                                {{ $video->title }}
                            </h3>
                            
                            <div class="text-sm text-[#706f6c] dark:text-[#A1A09A] space-y-1">
                                <p>
                                    From: 
                                    <a href="{{ route('playlists.show', $video->playlist) }}" 
                                       class="text-[#F53003] hover:text-[#d42a00] font-medium">
                                        {{ $video->playlist->title }}
                                    </a>
                                </p>
                                <p>By: {{ $video->user->firstname }} {{ $video->user->lastname }}</p>
                                <p>Added {{ $video->created_at->diffForHumans() }}</p>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <a href="{{ route('playlists.show', $video->playlist) }}" 
                                   class="text-[#F53003] hover:text-[#d42a00] text-sm font-medium">
                                    View Playlist
                                </a>
                                <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" 
                                   target="_blank"
                                   class="text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] text-sm font-medium">
                                    Watch on YouTube
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-[#f8f9fa] dark:bg-[#3E3E3A] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No videos yet</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6">Videos will appear here when they are added to playlists</p>
                <a href="{{ route('playlists.index') }}" 
                   class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                    Browse Playlists
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
