<x-layouts.landing title="{{ config('app.name') }} — Upravljanje aplikacijom">

    {{-- ===== NAVBAR ===== --}}
    <header class="navbar navbar-expand-md navbar-light sticky-top border-bottom">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <span class="fw-bold fs-4">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#landing-nav" aria-controls="landing-nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="landing-nav">
                <div class="navbar-nav ms-auto align-items-center gap-2">
                    {{-- Theme toggle --}}
                    <div class="nav-item d-none d-md-flex">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Uključi tamni način"
                           data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <i class="ti ti-moon icon"></i>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Uključi svijetli način"
                           data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <i class="ti ti-sun icon"></i>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-login me-1"></i>Prijava
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-user-plus me-1"></i>Registracija
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ===== HERO ===== --}}
    <div class="flex-fill">
        <div class="bg-primary-lt py-5">
            <div class="container py-4">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <span class="badge bg-primary text-white mb-3">
                                Laravel 13 + PostgreSQL + Tabler 1.4
                            </span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">
                            Upravljajte svime<br>
                            <span class="text-primary">na jednom mjestu</span>
                        </h1>
                        <p class="lead text-secondary mb-4">
                            Profesionalno strukturiran admin sustav s ulogama korisnika,
                            praćenjem aktivnosti i modernim sučeljem izgrađenim na Tabler UI frameworku.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="ti ti-rocket me-2"></i>
                                Započni besplatno
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="ti ti-login me-2"></i>
                                Prijavi se
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="card text-center p-3">
                                    <div class="text-primary mb-2">
                                        <i class="ti ti-users" style="font-size: 2rem;"></i>
                                    </div>
                                    <div class="h2 mb-0">14</div>
                                    <div class="text-secondary small">Korisnika</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card text-center p-3">
                                    <div class="text-green mb-2">
                                        <i class="ti ti-shield-check" style="font-size: 2rem;"></i>
                                    </div>
                                    <div class="h2 mb-0">2</div>
                                    <div class="text-secondary small">Uloge</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card text-center p-3">
                                    <div class="text-orange mb-2">
                                        <i class="ti ti-activity" style="font-size: 2rem;"></i>
                                    </div>
                                    <div class="h2 mb-0">100%</div>
                                    <div class="text-secondary small">Praćenje</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card text-center p-3">
                                    <div class="text-purple mb-2">
                                        <i class="ti ti-database" style="font-size: 2rem;"></i>
                                    </div>
                                    <div class="h2 mb-0">PgSQL</div>
                                    <div class="text-secondary small">Baza podataka</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FEATURE KARTICE ===== --}}
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Što sustav nudi?</h2>
                <p class="text-secondary">Sve što trebaš za upravljanje korisnicima i sadržajem</p>
            </div>

            <div class="row g-4">
                <!-- RBAC -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-red-lt text-red">
                                    <i class="ti ti-shield-lock"></i>
                                </span>
                            </div>
                            <h3 class="card-title">RBAC — Upravljanje ulogama</h3>
                            <p class="text-secondary">
                                Dvostupanjski sustav pristupa — <strong>Admin</strong> upravlja sustavom,
                                <strong>Korisnik</strong> pristupa vlastitim podacima.
                                Izgrađeno na Spatie Permission paketu.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-red-lt text-red me-1">admin</span>
                            <span class="badge bg-blue-lt text-blue">user</span>
                        </div>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-orange-lt text-orange">
                                    <i class="ti ti-activity"></i>
                                </span>
                            </div>
                            <h3 class="card-title">Praćenje aktivnosti</h3>
                            <p class="text-secondary">
                                Svaka akcija u sustavu se bilježi — tko je što napravio i kada.
                                Admin pregledava sve aktivnosti, korisnici samo svoje.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-orange-lt text-orange">Spatie ActivityLog</span>
                        </div>
                    </div>
                </div>

                <!-- Profil -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-blue-lt text-blue">
                                    <i class="ti ti-user-edit"></i>
                                </span>
                            </div>
                            <h3 class="card-title">Upravljanje profilom</h3>
                            <p class="text-secondary">
                                Svaki korisnik može uređivati vlastite podatke — ime, email i lozinku
                                — direktno iz svog dashboarda.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-blue-lt text-blue">Self-service profil</span>
                        </div>
                    </div>
                </div>

                <!-- Admin panel -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-purple-lt text-purple">
                                    <i class="ti ti-settings"></i>
                                </span>
                            </div>
                            <h3 class="card-title">Admin panel</h3>
                            <p class="text-secondary">
                                Administrator pregledava statistike, upravlja korisnicima i
                                dodjeljuje uloge iz preglednog Tabler sučelja.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-purple-lt text-purple">Samo za admina</span>
                        </div>
                    </div>
                </div>

                <!-- Log Viewer -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-cyan-lt text-cyan">
                                    <i class="ti ti-file-text"></i>
                                </span>
                            </div>
                            <h3 class="card-title">Log Viewer</h3>
                            <p class="text-secondary">
                                Pregled Laravel log datoteka direktno iz preglednika.
                                Dostupan isključivo administratorima sustava.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-cyan-lt text-cyan">Opcodes Log Viewer</span>
                        </div>
                    </div>
                </div>

                <!-- Stack -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="avatar bg-green-lt text-green">
                                    <i class="ti ti-stack-2"></i>
                                </span>
                            </div>
                            <h3 class="card-title">Moderan tech stack</h3>
                            <p class="text-secondary">
                                Laravel 13, PostgreSQL, Tabler 1.4, Vite — sve najnovije verzije
                                s punom podrškom za daljnji razvoj.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <span class="badge bg-green-lt text-green me-1">Laravel 13</span>
                            <span class="badge bg-green-lt text-green">PHP 8.2+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== CTA BANNER ===== --}}
        <div class="bg-primary py-5">
            <div class="container text-center text-white">
                <h2 class="fw-bold mb-3">Spreman/a za početak?</h2>
                <p class="mb-4 opacity-75">
                    Registriraj se i odmah pristupi svom dashboardu.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg">
                        <i class="ti ti-user-plus me-2"></i>
                        Kreiraj račun
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg">
                        <i class="ti ti-login me-2"></i>
                        Prijavi se
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STICKY FOOTER ===== --}}
    <footer class="footer footer-transparent d-print-none border-top">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col">
                    <p class="mb-0 text-secondary">
                        &copy; {{ date('Y') }}
                        <a href="{{ url('/') }}" class="link-secondary">{{ config('app.name') }}</a>
                        — Izgrađeno s
                        <a href="https://laravel.com" target="_blank" class="link-secondary">Laravel 13</a>
                        &amp;
                        <a href="https://tabler.io" target="_blank" class="link-secondary">Tabler</a>
                    </p>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-3">
                        <span class="badge bg-secondary-lt">
                            <i class="ti ti-brand-laravel me-1"></i>Laravel 13
                        </span>
                        <span class="badge bg-blue-lt text-blue">
                            <i class="ti ti-database me-1"></i>PostgreSQL
                        </span>
                        <span class="badge bg-green-lt text-green">
                            <i class="ti ti-layout me-1"></i>Tabler 1.4
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</x-layouts.landing>
