@extends('layouts.app')

@section('title', $playlist->title)

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('playlists.index') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mr-4">{{ $playlist->title }}</h1>
                        @if($playlist->is_public)
                            <span class="bg-green-500 text-white text-sm px-3 py-1 rounded-full">Public</span>
                        @else
                            <span class="bg-gray-500 text-white text-sm px-3 py-1 rounded-full">Private</span>
                        @endif
                    </div>
                    <div class="flex items-center text-[#706f6c] dark:text-[#A1A09A] text-sm space-x-4">
                        <span>by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}</span>
                        <span>•</span>
                        <span>{{ $playlist->videos->count() }} videos</span>
                        <span>•</span>
                        <span>Created {{ $playlist->created_at->diffForHumans() }}</span>
                    </div>
                    @if($playlist->description)
                        <p class="text-[#706f6c] dark:text-[#A1A09A] mt-2">{{ $playlist->description }}</p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-4">
                @if($playlist->videos->count() > 0)
                    <a href="{{ route('playlists.play', $playlist) }}" 
                       class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Play All
                    </a>
                @endif
                
                @if($playlist->user_id === Auth::id())
                    <a href="{{ route('playlists.add-video', $playlist) }}" 
                       class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] px-6 py-3 rounded-lg font-semibold hover:bg-[#f8f9fa] dark:hover:bg-[#3E3E3A] transition duration-300">
                        Add Videos
                    </a>
                    <a href="{{ route('playlists.edit', $playlist) }}" 
                       class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] px-3 py-3">
                        Edit Playlist
                    </a>
                @endif
            </div>
        </div>

        <!-- Videos List -->
        @if($playlist->videos->count() > 0)
            <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Videos ({{ $playlist->videos->count() }})</h2>
                </div>
                
                <div class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                    @foreach($playlist->videos as $index => $video)
                        <div class="p-6 hover:bg-[#f8f9fa] dark:hover:bg-[#0a0a0a] transition duration-300">
                            <div class="flex items-center space-x-4">
                                <!-- Video Index -->
                                <div class="flex-shrink-0 w-8 text-center">
                                    <span class="text-[#706f6c] dark:text-[#A1A09A] text-sm font-medium">{{ $index + 1 }}</span>
                                </div>
                                
                                <!-- Video Thumbnail -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $video->thumbnail_url }}" 
                                         alt="{{ $video->title }}" 
                                         class="w-24 h-16 object-cover rounded-lg">
                                </div>
                                
                                <!-- Video Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] truncate">
                                        {{ $video->title }}
                                    </h3>
                                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                                        Added {{ $video->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex items-center space-x-2">
                                    <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" 
                                       target="_blank"
                                       class="text-[#F53003] hover:text-[#d42a00] p-2 rounded-lg hover:bg-[#F53003] hover:bg-opacity-10 transition duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </a>
                                    @if($playlist->user_id === Auth::id())
                                        <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Remove this video from the playlist?')"
                                                    class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900 dark:hover:bg-opacity-20 transition duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-12 text-center">
                <div class="w-20 h-20 bg-[#f8f9fa] dark:bg-[#3E3E3A] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No videos in this playlist</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6">Start building your playlist by adding some videos</p>
                @if($playlist->user_id === Auth::id())
                    <a href="{{ route('playlists.add-video', $playlist) }}" 
                       class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Add First Video
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
