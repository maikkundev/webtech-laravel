<!-- Navigation bar with Bootstrap classes -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid px-4">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('looplogo.png') }}" alt="Website Logo" class="img-fluid" style="max-height: 60px;">
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
                        <i class="bi bi-card-list me-1"></i>Lists
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
                                <a class="dropdown-item" href="{{ url('/lists/create') }}">
                                    <i class="bi bi-plus-circle me-2"></i>Create List
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/playback') }}">
                                    <i class="bi bi-play-btn me-2"></i>Αναπαραγωγή περιεχομένου
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/followed-lists/edit') }}">
                                    <i class="bi bi-pencil-square me-2"></i>Επεξεργασία λιστών χρηστών που ακολουθεί
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/export-open-data') }}">
                                    <i class="bi bi-file-earmark-arrow-down me-2"></i>Εξαγωγή open data
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
                    <button class="theme-toggle" id="theme-toggle" title="Εναλλαγή θέματος">
                        <i id="theme-icon" class="bi bi-moon-fill"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
