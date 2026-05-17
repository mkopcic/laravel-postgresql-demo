<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">

                    @auth
                        @role('admin')
                            <!-- Admin: Dashboard -->
                            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-home icon"></i>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>

                            <!-- Admin: Korisnici -->
                            <li class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.users') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-users icon"></i>
                                    </span>
                                    <span class="nav-link-title">Korisnici</span>
                                </a>
                            </li>

                            <!-- Admin: Alati dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-tool icon"></i>
                                    </span>
                                    <span class="nav-link-title">Alati</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/log-viewer" target="_blank">
                                        <i class="ti ti-file-text me-2"></i>
                                        Log Viewer
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/showcase') }}">
                                        <i class="ti ti-palette me-2"></i>
                                        UI Showcase
                                    </a>
                                </div>
                            </li>
                        @else
                            <!-- User: Dashboard -->
                            <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-home icon"></i>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>

                            <!-- User: Profil -->
                            <li class="nav-item {{ request()->routeIs('user.profile*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.dashboard') }}#profil">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-user-edit icon"></i>
                                    </span>
                                    <span class="nav-link-title">Moj profil</span>
                                </a>
                            </li>
                        @endrole
                    @else
                        <!-- Gost: Dashboard link na root -->
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-home icon"></i>
                                </span>
                                <span class="nav-link-title">Početna</span>
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </div>
</header>
