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
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                       data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="ti ti-moon icon"></i>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                       data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="ti ti-sun icon"></i>
                    </a>
                </div>
            </div>

            <!-- Notifications -->
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                   aria-label="Show notifications" data-bs-auto-close="outside">
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
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm">
                        <i class="ti ti-user"></i>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Admin</div>
                        <div class="mt-1 small text-secondary">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Profil</a>
                    <a href="#" class="dropdown-item">Postavke</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Odjava</a>
                </div>
            </div>
        </div>
    </div>
</header>
