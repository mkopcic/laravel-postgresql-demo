<x-layouts.app title="Dobrodošli - Dashboard">
    <x-slot name="head">
        <!-- Additional head content if needed -->
        <script src="{{ asset('tabler/dist/js/tabler-theme.min.js') }}"></script>
    </x-slot>

    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Dobrodošli u Laravel + Tabler Admin
                        </h2>
                        <div class="text-secondary mt-1">
                            Profesionalno strukturiran Laravel projekt s Tabler UI komponentama
                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <x-ui.button variant="primary" icon="ti ti-plus">
                                Novi zapis
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">

                <!-- Alert Example -->
                <x-ui.alert type="success" :dismissible="true" class="mb-3">
                    <strong>Odlično!</strong> Uspješno ste postavili Tabler layout sistem.
                </x-ui.alert>

                <!-- Cards Row -->
                    <!-- Cards Row -->
                    <div class="row row-deck row-cards">
                        <!-- App Info Card (prva u gridu) -->
                        <div class="col-sm-6 col-lg-3">
                            <x-ui.card class="card-sm">
                                <div class="d-flex align-items-center">
                                    <span class="bg-indigo text-white avatar">
                                        <i class="ti ti-info-circle"></i>
                                    </span>
                                    <div class="ms-3">
                                        <div class="text-secondary">App info</div>
                                        <div class="small mb-1">PHP: <strong>8.5</strong></div>
                                        <div class="small mb-1">Laravel: <strong>12.57.0</strong></div>
                                        <div class="small mb-1">DB: <strong>pgsql</strong></div>
                                    </div>
                                </div>
                            </x-ui.card>
                        </div>
                    <!-- Card 1 -->
                    <div class="col-sm-6 col-lg-3">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-primary text-white avatar">
                                    <i class="ti ti-users"></i>
                                </span>
                                <div class="ms-3">
                                    <div class="text-secondary">Korisnici</div>
                                    <div class="h1 mb-0">132</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-sm-6 col-lg-3">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-green text-white avatar">
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <div class="ms-3">
                                    <div class="text-secondary">Narudžbe</div>
                                    <div class="h1 mb-0">78</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-sm-6 col-lg-3">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-orange text-white avatar">
                                    <i class="ti ti-chart-line"></i>
                                </span>
                                <div class="ms-3">
                                    <div class="text-secondary">Prihod</div>
                                    <div class="h1 mb-0">€8,450</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-sm-6 col-lg-3">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-red text-white avatar">
                                    <i class="ti ti-alert-triangle"></i>
                                </span>
                                <div class="ms-3">
                                    <div class="text-secondary">Greške</div>
                                    <div class="h1 mb-0">3</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                <!-- Installed Packages Section -->
                <div class="row row-deck row-cards mt-3">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">
                                    <i class="ti ti-package me-2"></i>
                                    Instalirani Paketi & Alati
                                </h3>
                            </x-slot>

                            <div class="row g-3">
                                <!-- Log Viewer -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-blue-lt avatar me-3">
                                            <i class="ti ti-file-text"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Log Viewer</h4>
                                            <p class="text-secondary mb-2">Pregled Laravel log fileova</p>
                                            <a href="/log-viewer" target="_blank" class="btn btn-sm btn-primary">
                                                Otvori Log Viewer
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Backup -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-green-lt avatar me-3">
                                            <i class="ti ti-database-export"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Spatie Backup</h4>
                                            <p class="text-secondary mb-2">Backupi aplikacije i baze</p>
                                            <code class="text-muted small">php artisan backup:run</code>
                                        </div>
                                    </div>
                                </div>

                                <!-- Media Library -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-purple-lt avatar me-3">
                                            <i class="ti ti-photo"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Media Library</h4>
                                            <p class="text-secondary mb-2">Upravljanje medijama</p>
                                            <span class="badge bg-purple">Instaliran</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Activity Log -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-orange-lt avatar me-3">
                                            <i class="ti ti-activity"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Activity Log</h4>
                                            <p class="text-secondary mb-2">Praćenje aktivnosti korisnika</p>
                                            <span class="badge bg-orange">Instaliran</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Permissions -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-red-lt avatar me-3">
                                            <i class="ti ti-shield-lock"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Permissions</h4>
                                            <p class="text-secondary mb-2">Upravljanje rolama i dozvolama</p>
                                            <span class="badge bg-red">Instaliran</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Debugbar (Dev) -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <span class="bg-cyan-lt avatar me-3">
                                            <i class="ti ti-bug"></i>
                                        </span>
                                        <div>
                                            <h4 class="mb-1">Debugbar</h4>
                                            <p class="text-secondary mb-2">Debug toolbar (samo dev)</p>
                                            <span class="badge bg-cyan">Dev Only</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="row row-deck row-cards mt-3">
                    <!-- Table Example -->
                    <div class="col-lg-8">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">Nedavne aktivnosti</h3>
                            </x-slot>

                            <x-ui.table :headers="['Korisnik', 'Aktivnost', 'Datum', 'Status']">
                                <tr>
                                    <td>Ivan Horvat</td>
                                    <td>Kreirao novu narudžbu</td>
                                    <td>2 sata</td>
                                    <td><span class="badge bg-success">Uspjeh</span></td>
                                </tr>
                                <tr>
                                    <td>Ana Kovač</td>
                                    <td>Ažurirala profil</td>
                                    <td>4 sata</td>
                                    <td><span class="badge bg-info">Info</span></td>
                                </tr>
                                <tr>
                                    <td>Marko Marić</td>
                                    <td>Prijava u sistem</td>
                                    <td>6 sati</td>
                                    <td><span class="badge bg-success">Uspjeh</span></td>
                                </tr>
                                <tr>
                                    <td>Petra Novak</td>
                                    <td>Pokušaj prijave</td>
                                    <td>8 sati</td>
                                    <td><span class="badge bg-warning">Upozorenje</span></td>
                                </tr>
                            </x-ui.table>
                        </x-ui.card>
                    </div>

                    <!-- Form Example -->
                    <div class="col-lg-4">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">Brzi unos</h3>
                            </x-slot>

                            <form>
                                <x-ui.form-input
                                    name="name"
                                    label="Ime"
                                    placeholder="Unesite ime"
                                    icon="ti ti-user"
                                    :required="true"
                                />

                                <x-ui.form-input
                                    name="email"
                                    type="email"
                                    label="Email"
                                    placeholder="email@primjer.com"
                                    icon="ti ti-mail"
                                    :required="true"
                                />

                                <x-ui.form-input
                                    name="phone"
                                    type="tel"
                                    label="Telefon"
                                    placeholder="+385 99 123 4567"
                                    icon="ti ti-phone"
                                    hint="Format: +385 99 123 4567"
                                />

                                <div class="d-flex gap-2">
                                    <x-ui.button variant="primary" type="submit" class="w-100">
                                        Spremi
                                    </x-ui.button>
                                    <x-ui.button variant="secondary" :outline="true" type="button" class="w-100">
                                        Odustani
                                    </x-ui.button>
                                </div>
                            </form>
                        </x-ui.card>
                    </div>
                </div>
    <!-- Trigger za modal -->
    <div class="mt-4">
        <x-ui.button variant="primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Otvori Modal
        </x-ui.button>
    </div>
                <!-- Additional Alerts -->
                <div class="row mt-3">
                    <div class="col-12">
                        <x-ui.alert type="info" class="mb-3">
                            <strong>Info:</strong> Sve komponente su dostupne u <code>resources/views/components/ui/</code> folderu.
                        </x-ui.alert>

                        <x-ui.alert type="warning">
                            <strong>Napomena:</strong> Ovo je demo stranica. Prilagodite je prema svojim potrebama.
                        </x-ui.alert>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <x-slot name="scripts">
        <!-- Modal Example (if needed) -->
        <x-ui.modal id="exampleModal" title="Primjer modala" size="lg">
            <p>Ovo je primjer modal dialoga.</p>
            <x-slot name="footer">
                <x-ui.button variant="secondary" data-bs-dismiss="modal">
                    Zatvori
                </x-ui.button>
                <x-ui.button variant="primary">
                    Spremi promjene
                </x-ui.button>
            </x-slot>
        </x-ui.modal>

        <!-- Custom scripts if needed -->
    </x-slot>
</x-layouts.app>
