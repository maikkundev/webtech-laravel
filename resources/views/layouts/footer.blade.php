<!-- Footer -->
<footer class="mt-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">{{ config('app.name', 'Laravel') }}</h6>
                <small class="text-muted">
                    © {{ date('Y') }} WebTech Laravel. All rights reserved.
                </small>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li><a href="{{ route('help') }}" class="text-decoration-none">Help</a></li>
                    <li><a href="{{ route('users.discover') }}" class="text-decoration-none">Discover Users</a></li>
                    <li><a href="{{ route('search.index') }}" class="text-decoration-none">Search Playlists</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
