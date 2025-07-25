<div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden hover:shadow-lg transition duration-300">
    <!-- Playlist Thumbnail -->
    <div class="relative h-48 bg-gradient-to-br from-[#F53003] to-[#d42a00]">
        @if($playlist->videos->count() > 0)
            <img src="{{ $playlist->videos->first()->thumbnail_url }}" 
                 alt="{{ $playlist->title }}" 
                 class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="text-center text-white">
                <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <span class="text-sm font-medium">{{ $playlist->videos_count ?? 0 }} videos</span>
            </div>
        </div>
        @if($playlist->is_public)
            <div class="absolute top-3 right-3">
                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Public</span>
            </div>
        @else
            <div class="absolute top-3 right-3">
                <span class="bg-gray-500 text-white text-xs px-2 py-1 rounded-full">Private</span>
            </div>
        @endif
    </div>

    <div class="p-6">
        <div class="mb-4">
            <h3 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                {{ $playlist->title }}
            </h3>
            
            @if($showOwner)
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">
                    by {{ $playlist->user->firstname }} {{ $playlist->user->lastname }}
                </p>
            @endif

            @if($playlist->description)
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm line-clamp-2">
                    {{ $playlist->description }}
                </p>
            @endif
        </div>

        <div class="flex items-center justify-between text-sm">
            <div class="text-[#706f6c] dark:text-[#A1A09A]">
                {{ $playlist->created_at->diffForHumans() }}
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('playlists.show', $playlist) }}" 
                   class="text-[#F53003] hover:text-[#d42a00] font-medium">
                    View
                </a>
                @if($playlist->videos_count > 0)
                    <a href="{{ route('playlists.play', $playlist) }}" 
                       class="text-[#F53003] hover:text-[#d42a00] font-medium">
                        Play
                    </a>
                @endif
                @if(!$showOwner)
                    <a href="{{ route('playlists.edit', $playlist) }}" 
                       class="text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] font-medium">
                        Edit
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
