@extends('layouts.app')

@section('title', 'Playlists')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Playlists</h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Manage your video playlists</p>
            </div>
            <a href="{{ route('playlists.create') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                Create Playlist
            </a>
        </div>

        <!-- Playlists Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($playlists as $playlist)
                <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                                {{ $playlist->title }}
                            </h3>
                            <span class="text-sm text-[#706f6c] dark:text-[#A1A09A] bg-[#f8f9fa] dark:bg-[#3E3E3A] px-2 py-1 rounded">
                                {{ $playlist->videos_count ?? 0 }} videos
                            </span>
                        </div>

                        @if($playlist->description)
                            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-3">
                                {{ $playlist->description }}
                            </p>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Created {{ $playlist->created_at->diffForHumans() }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('playlists.show', $playlist) }}" class="text-[#F53003] hover:text-[#d42a00] font-medium">
                                    View
                                </a>
                                <a href="{{ route('playlists.edit', $playlist) }}" class="text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] font-medium">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No playlists yet</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Create your first playlist to get started</p>
                    <a href="{{ route('playlists.create') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Create Your First Playlist
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
