<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo -->
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ url('/') }}">
                <h2 class="mb-0">{{ config('app.name', 'Laravel') }}</h2>
            </a>
        </div>

        <!-- Right side navbar -->
        <div class="navbar-nav flex-row order-md-last">
            <!-- Theme toggle -->
            <div class="d-none d-md-flex">
                <div class="nav-item">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Uključi tamni način"
                       data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="ti ti-moon icon"></i>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Uključi svijetli način"
                       data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="ti ti-sun icon"></i>
                    </a>
                </div>
            </div>

            @auth
                <!-- Notifications -->
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                       aria-label="Prikaži obavijesti" data-bs-auto-close="outside">
                        <i class="ti ti-bell icon"></i>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Obavijesti</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="text-secondary">Nema novih obavijesti</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User menu -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Otvori korisnički izbornik">
                        <span class="avatar avatar-sm bg-secondary-lt">
                            <i class="ti ti-user"></i>
                        </span>
                        <div class="d-none d-xl-block ps-2">
                            <div class="fw-medium">{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-secondary">
                                @role('admin')
                                    Administrator
                                @else
                                    Korisnik
                                @endrole
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="ti ti-layout-dashboard me-2"></i>Admin Dashboard
                            </a>
                            <a href="{{ route('admin.users') }}" class="dropdown-item">
                                <i class="ti ti-users me-2"></i>Korisnici
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                                <i class="ti ti-layout-dashboard me-2"></i>Dashboard
                            </a>
                        @endrole
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="ti ti-logout me-2"></i>Odjava
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-login me-1"></i>Prijava
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>
