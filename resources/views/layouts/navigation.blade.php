<!-- Navigation bar with Bootstrap classes -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid px-4">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="/">
            @php
                $isDark = isset($_COOKIE['bs-theme']) && $_COOKIE['bs-theme'] === 'dark';
                $logoSrc = $isDark ? asset('logo-dark.png') : asset('looplogo.png');
            @endphp
            <img id="navbar-logo" src="{{ $logoSrc }}" alt="Website Logo" class="img-fluid" style="max-height: 60px;">
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Free Access Pages -->
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="bi bi-house me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/help') }}">
                        <i class="bi bi-question-circle me-1"></i>Help
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/users/discover') }}">
                        <i class="bi bi-card-list me-1"></i>Public Playlists
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/search') }}">
                        <i class="bi bi-search me-1"></i>Search
                    </a>
                </li>
            </ul>

            <!-- Right side navigation -->
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('playlists.create') }}">
                                    <i class="bi bi-plus-circle me-2"></i>Create List
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('playback.index') }}">
                                    <i class="bi bi-play-btn me-2"></i>Content Playback
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('followed-lists.edit') }}">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Followed User Lists
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('export.index') }}">
                                    <i class="bi bi-file-earmark-arrow-down me-2"></i>Export Open Data
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

                <!-- Theme Toggle -->
                <li class="nav-item me-2">
                    <button class="theme-toggle" id="theme-toggle" title="Toggle Theme">
                        <i id="theme-icon" class="bi bi-moon-fill"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Function to get cookie value by name
    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    // update logo
    document.getElementById('theme-toggle').addEventListener('click', function() {
        setTimeout(function() {
            const currentTheme = getCookie('bs-theme');
            const isDark = currentTheme === 'dark';
            const logoSrc = isDark ? '{{ asset('logo-dark.png') }}' : '{{ asset('looplogo.png') }}';
            document.getElementById('navbar-logo').src = logoSrc;
        }, 100);
    });
</script>
