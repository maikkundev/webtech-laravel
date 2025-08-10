<!-- Navigation bar with Bootstrap classes -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid px-4">
        <!-- Brand/Logo -->
        <a class="navbar-brand fw-bold text-dark" href="/">
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="bi bi-house me-1"></i>Home
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
