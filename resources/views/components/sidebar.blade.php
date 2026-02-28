<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <!-- Dashboard -->
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home icon"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    <!-- Interface Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-package icon"></i>
                            </span>
                            <span class="nav-link-title">Sučelje</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="#">Buttons</a>
                                    <a class="dropdown-item" href="#">Cards</a>
                                    <a class="dropdown-item" href="#">Alerts</a>
                                    <a class="dropdown-item" href="#">Modals</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Forms -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-form" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-checkbox icon"></i>
                            </span>
                            <span class="nav-link-title">Forme</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Form elementi</a>
                            <a class="dropdown-item" href="#">Validacija</a>
                        </div>
                    </li>

                    <!-- Extra -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-star icon"></i>
                            </span>
                            <span class="nav-link-title">Dodatno</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Postavke</a>
                            <a class="dropdown-item" href="#">Dokumentacija</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
