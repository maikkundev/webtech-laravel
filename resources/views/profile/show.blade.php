@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </h1>
                    <p class="mt-1 text-sm text-[#6b6b64] dark:text-[#A8A8A3]">@{{ $user->username }}</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-[#F53003] hover:bg-[#d42a00] rounded-md transition-colors">
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User Information -->
                <div>
                    <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">User Information</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-[#6b6b64] dark:text-[#A8A8A3]">Full Name</label>
                            <p class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $user->firstname }} {{ $user->lastname }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#6b6b64] dark:text-[#A8A8A3]">Username</label>
                            <p class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $user->username }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#6b6b64] dark:text-[#A8A8A3]">Email</label>
                            <p class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#6b6b64] dark:text-[#A8A8A3]">Member Since</label>
                            <p class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $user->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div>
                    <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Statistics</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-[#f9f9f8] dark:bg-[#0a0a0a] p-4 rounded-lg">
                            <div class="text-2xl font-semibold text-[#F53003]">{{ $playlists->count() }}</div>
                            <div class="text-sm text-[#6b6b64] dark:text-[#A8A8A3]">Playlists</div>
                        </div>
                        <div class="bg-[#f9f9f8] dark:bg-[#0a0a0a] p-4 rounded-lg">
                            <div class="text-2xl font-semibold text-[#F53003]">{{ $user->videos->count() }}</div>
                            <div class="text-sm text-[#6b6b64] dark:text-[#A8A8A3]">Videos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Playlists -->
    @if($playlists->count() > 0)
    <div class="mt-8 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Recent Playlists</h2>
                <a href="{{ route('playlists.index') }}"
                   class="text-sm text-[#F53003] hover:text-[#d42a00] transition-colors">
                    View All
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($playlists->take(6) as $playlist)
                <div class="bg-[#f9f9f8] dark:bg-[#0a0a0a] p-4 rounded-lg hover:shadow-md transition-shadow">
                    <h3 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        <a href="{{ route('playlists.show', $playlist) }}" class="hover:text-[#F53003] transition-colors">
                            {{ $playlist->title }}
                        </a>
                    </h3>
                    @if($playlist->description)
                    <p class="text-sm text-[#6b6b64] dark:text-[#A8A8A3] mb-2">
                        {{ Str::limit($playlist->description, 100) }}
                    </p>
                    @endif
                    <div class="flex justify-between items-center text-xs text-[#6b6b64] dark:text-[#A8A8A3]">
                        <span>{{ $playlist->videos->count() }} videos</span>
                        <span>{{ $playlist->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="mt-8 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg shadow-sm">
        <div class="p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-[#6b6b64] dark:text-[#A8A8A3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2zm12-3c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">No playlists yet</h3>
            <p class="mt-1 text-sm text-[#6b6b64] dark:text-[#A8A8A3]">Get started by creating your first playlist.</p>
            <div class="mt-6">
                <a href="{{ route('playlists.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#F53003] hover:bg-[#d42a00] transition-colors">
                    Create Playlist
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
