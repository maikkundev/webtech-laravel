<!-- Footer -->
<footer class="bg-white dark:bg-[#161615] border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">
                    {{ config('app.name', 'WebTech Laravel') }}
                </h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                    A modern Laravel application for managing video playlists and content.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-md font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] dark:hover:text-[#FF4433] text-sm">Home</a></li>
                    <li><a href="{{ route('playlists.index') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] dark:hover:text-[#FF4433] text-sm">Playlists</a></li>
                    <li><a href="{{ route('videos.index') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#F53003] dark:hover:text-[#FF4433] text-sm">Videos</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-md font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Contact</h4>
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                    Built with Laravel {{ app()->version() }}
                </p>
            </div>
        </div>

        <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-8 pt-8 text-center">
            <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                © {{ date('Y') }} {{ config('app.name', 'WebTech Laravel') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>
