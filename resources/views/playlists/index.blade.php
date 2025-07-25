@extends('layouts.app')

@section('title', 'Playlists')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Playlists</h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Manage your video playlists and discover others</p>
            </div>
            <a href="{{ route('playlists.create') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                Create Playlist
            </a>
        </div>

        <!-- My Playlists Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">My Playlists</h2>
                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ $userPlaylists->count() }} playlists</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($userPlaylists as $playlist)
                    @include('playlists.partials.playlist-card', ['playlist' => $playlist, 'showOwner' => false])
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

        <!-- Public Playlists Section -->
        @if($publicPlaylists->count() > 0)
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Discover Public Playlists</h2>
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ $publicPlaylists->count() }} playlists</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($publicPlaylists as $playlist)
                        @include('playlists.partials.playlist-card', ['playlist' => $playlist, 'showOwner' => true])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
