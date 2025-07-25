<!-- Navigation -->
<nav class="bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                    {{ config('app.name', 'WebTech Laravel') }}
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ url('/') }}" class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] px-3 py-2 text-sm font-medium">
                    Home
                </a>
                <a href="{{ route('playlists.index') }}" class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] px-3 py-2 text-sm font-medium">
                    Playlists
                </a>
                <a href="{{ route('videos.index') }}" class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] px-3 py-2 text-sm font-medium">
                    Videos
                </a>
            </div>

            <!-- Authentication Links -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="sm:hidden text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                @auth
                    <div class="relative group">
                        <button class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] px-3 py-2 text-sm font-medium flex items-center">
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#F53003] hover:text-white">
                                View Profile
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#F53003] hover:text-white">
                                Edit Profile
                            </a>
                            <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A]"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#F53003] hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433] px-3 py-2 text-sm font-medium">
                            Login
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-[#F53003] hover:bg-[#d42a00] text-white px-4 py-2 rounded-sm text-sm font-medium">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="sm:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433]">
                    Home
                </a>
                <a href="{{ route('playlists.index') }}" class="block px-3 py-2 text-base font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433]">
                    Playlists
                </a>
                <a href="{{ route('videos.index') }}" class="block px-3 py-2 text-base font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#FF4433]">
                    Videos
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu?.classList.toggle('hidden');
});
</script>
