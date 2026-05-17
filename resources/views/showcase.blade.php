<x-layouts.app title="UI Showcase — {{ config('app.name') }}">
    <x-slot name="head">
        <script src="{{ asset('tabler/dist/js/tabler-theme.min.js') }}"></script>
    </x-slot>

    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Razvojni alat</div>
                        <h2 class="page-title">UI Showcase — Tabler Komponente</h2>
                        <div class="text-secondary mt-1">
                            Pregled svih dostupnih Blade komponenti s live primjerima
                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="https://tabler.io/docs" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="ti ti-external-link me-1"></i>Tabler Docs
                            </a>
                            <a href="https://tabler-icons.io" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="ti ti-icons me-1"></i>Sve ikone
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">

                {{-- ===== NAVIGACIJA PO SEKCIJAMA ===== --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(['alerts' => 'Alerti', 'buttons' => 'Gumbi', 'cards' => 'Kartice', 'badges' => 'Bedževi', 'avatars' => 'Avatari', 'forms' => 'Forme', 'table' => 'Tablica', 'modals' => 'Modali', 'colors' => 'Boje', 'icons' => 'Ikone'] as $id => $label)
                                        <a href="#{{ $id }}" class="btn btn-sm btn-outline-secondary">{{ $label }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== 1. ALERTI ===== --}}
                <div class="row row-deck row-cards mb-4" id="alerts">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-bell me-2"></i>Alerti</h3>
                                <div class="card-options">
                                    <code class="text-secondary small">x-ui.alert</code>
                                </div>
                            </x-slot>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <x-ui.alert type="info">
                                        <strong>Info:</strong> Informativna poruka za korisnika.
                                    </x-ui.alert>
                                    <x-ui.alert type="success">
                                        <strong>Uspjeh!</strong> Podatci su uspješno spremljeni.
                                    </x-ui.alert>
                                    <x-ui.alert type="warning">
                                        <strong>Upozorenje!</strong> Provjeri podatke prije nastavka.
                                    </x-ui.alert>
                                    <x-ui.alert type="danger">
                                        <strong>Greška!</strong> Nešto je pošlo po krivu.
                                    </x-ui.alert>
                                </div>
                                <div class="col-md-6">
                                    <x-ui.alert type="success" :dismissible="true">
                                        Ovaj alert može se zatvoriti klikom na X.
                                    </x-ui.alert>
                                    <x-ui.alert type="info" icon="ti ti-star">
                                        Alert s custom ikonom (<code>ti-star</code>).
                                    </x-ui.alert>
                                    <x-ui.alert type="warning">
                                        <strong>Obavezna polja:</strong>
                                        <ul class="mt-1 mb-0 ps-3">
                                            <li>Ime i prezime</li>
                                            <li>Email adresa</li>
                                        </ul>
                                    </x-ui.alert>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 2. GUMBI ===== --}}
                <div class="row row-deck row-cards mb-4" id="buttons">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-hand-click me-2"></i>Gumbi</h3>
                                <div class="card-options">
                                    <code class="text-secondary small">x-ui.button</code>
                                </div>
                            </x-slot>

                            <p class="text-secondary mb-3">Varijante</p>
                            <div class="btn-list mb-4">
                                <x-ui.button variant="primary">Primary</x-ui.button>
                                <x-ui.button variant="secondary">Secondary</x-ui.button>
                                <x-ui.button variant="success">Success</x-ui.button>
                                <x-ui.button variant="warning">Warning</x-ui.button>
                                <x-ui.button variant="danger">Danger</x-ui.button>
                                <x-ui.button variant="info">Info</x-ui.button>
                                <x-ui.button variant="light">Light</x-ui.button>
                                <x-ui.button variant="dark">Dark</x-ui.button>
                            </div>

                            <p class="text-secondary mb-3">Outline</p>
                            <div class="btn-list mb-4">
                                <x-ui.button variant="primary" :outline="true">Primary</x-ui.button>
                                <x-ui.button variant="secondary" :outline="true">Secondary</x-ui.button>
                                <x-ui.button variant="success" :outline="true">Success</x-ui.button>
                                <x-ui.button variant="warning" :outline="true">Warning</x-ui.button>
                                <x-ui.button variant="danger" :outline="true">Danger</x-ui.button>
                            </div>

                            <p class="text-secondary mb-3">S ikonama</p>
                            <div class="btn-list mb-4">
                                <x-ui.button variant="primary" icon="ti ti-plus">Dodaj novi</x-ui.button>
                                <x-ui.button variant="success" icon="ti ti-check">Spremi</x-ui.button>
                                <x-ui.button variant="danger" icon="ti ti-trash" :outline="true">Obriši</x-ui.button>
                                <x-ui.button variant="secondary" icon="ti ti-download">Preuzmi</x-ui.button>
                                <x-ui.button variant="info" icon="ti ti-search">Pretraži</x-ui.button>
                            </div>

                            <p class="text-secondary mb-3">Veličine</p>
                            <div class="btn-list align-items-center">
                                <x-ui.button variant="primary" size="lg">Veliki (lg)</x-ui.button>
                                <x-ui.button variant="primary">Normalni</x-ui.button>
                                <x-ui.button variant="primary" size="sm">Mali (sm)</x-ui.button>
                                <x-ui.button variant="secondary" disabled>Disabled</x-ui.button>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 3. KARTICE ===== --}}
                <div class="row row-deck row-cards mb-4" id="cards">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-layout-cards me-2"></i>Kartice</h3>
                                <div class="card-options">
                                    <code class="text-secondary small">x-ui.card</code>
                                </div>
                            </x-slot>

                            <div class="row g-3">
                                {{-- Jednostavna --}}
                                <div class="col-md-4">
                                    <x-ui.card>
                                        <p class="mb-0">Jednostavna kartica bez headera i footera.</p>
                                    </x-ui.card>
                                </div>

                                {{-- S headerom --}}
                                <div class="col-md-4">
                                    <x-ui.card>
                                        <x-slot name="header">
                                            <h3 class="card-title">Naslov kartice</h3>
                                        </x-slot>
                                        <p class="mb-0">Kartica s headerom i sadržajem.</p>
                                    </x-ui.card>
                                </div>

                                {{-- S footerom --}}
                                <div class="col-md-4">
                                    <x-ui.card>
                                        <x-slot name="header">
                                            <h3 class="card-title">Header + Footer</h3>
                                        </x-slot>
                                        <p class="mb-0">Kartica s headerom i footerom.</p>
                                        <x-slot name="footer">
                                            <div class="d-flex justify-content-end">
                                                <x-ui.button variant="primary" size="sm">Akcija</x-ui.button>
                                            </div>
                                        </x-slot>
                                    </x-ui.card>
                                </div>

                                {{-- Stat kartice --}}
                                <div class="col-md-3">
                                    <x-ui.card class="card-sm">
                                        <div class="d-flex align-items-center">
                                            <span class="bg-primary text-white avatar me-3">
                                                <i class="ti ti-users"></i>
                                            </span>
                                            <div>
                                                <div class="text-secondary">Korisnici</div>
                                                <div class="h1 mb-0">1,248</div>
                                            </div>
                                        </div>
                                    </x-ui.card>
                                </div>
                                <div class="col-md-3">
                                    <x-ui.card class="card-sm">
                                        <div class="d-flex align-items-center">
                                            <span class="bg-green text-white avatar me-3">
                                                <i class="ti ti-shopping-cart"></i>
                                            </span>
                                            <div>
                                                <div class="text-secondary">Narudžbe</div>
                                                <div class="h1 mb-0">342</div>
                                            </div>
                                        </div>
                                    </x-ui.card>
                                </div>
                                <div class="col-md-3">
                                    <x-ui.card class="card-sm">
                                        <div class="d-flex align-items-center">
                                            <span class="bg-orange text-white avatar me-3">
                                                <i class="ti ti-chart-line"></i>
                                            </span>
                                            <div>
                                                <div class="text-secondary">Prihod</div>
                                                <div class="h1 mb-0">€12,450</div>
                                            </div>
                                        </div>
                                    </x-ui.card>
                                </div>
                                <div class="col-md-3">
                                    <x-ui.card class="card-sm">
                                        <div class="d-flex align-items-center">
                                            <span class="bg-red text-white avatar me-3">
                                                <i class="ti ti-alert-triangle"></i>
                                            </span>
                                            <div>
                                                <div class="text-secondary">Greške</div>
                                                <div class="h1 mb-0">3</div>
                                            </div>
                                        </div>
                                    </x-ui.card>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 4. BEDŽEVI + AVATARI ===== --}}
                <div class="row row-deck row-cards mb-4">
                    <div class="col-md-6" id="badges">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-tag me-2"></i>Bedževi</h3>
                                <div class="card-options"><code class="text-secondary small">badge</code></div>
                            </x-slot>

                            <p class="text-secondary mb-2">Solidni</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-primary">Primary</span>
                                <span class="badge bg-secondary">Secondary</span>
                                <span class="badge bg-success">Success</span>
                                <span class="badge bg-warning">Warning</span>
                                <span class="badge bg-danger">Danger</span>
                                <span class="badge bg-info">Info</span>
                                <span class="badge bg-red">Red</span>
                                <span class="badge bg-green">Green</span>
                                <span class="badge bg-blue">Blue</span>
                                <span class="badge bg-orange">Orange</span>
                                <span class="badge bg-purple">Purple</span>
                                <span class="badge bg-cyan">Cyan</span>
                                <span class="badge bg-pink">Pink</span>
                            </div>

                            <p class="text-secondary mb-2">Light (lt) varijante</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-red-lt text-red">Red</span>
                                <span class="badge bg-green-lt text-green">Green</span>
                                <span class="badge bg-blue-lt text-blue">Blue</span>
                                <span class="badge bg-orange-lt text-orange">Orange</span>
                                <span class="badge bg-purple-lt text-purple">Purple</span>
                                <span class="badge bg-cyan-lt text-cyan">Cyan</span>
                                <span class="badge bg-yellow-lt text-yellow">Yellow</span>
                                <span class="badge bg-pink-lt text-pink">Pink</span>
                            </div>

                            <p class="text-secondary mb-2">S ikonom</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-green"><i class="ti ti-check me-1"></i>Aktivan</span>
                                <span class="badge bg-red"><i class="ti ti-x me-1"></i>Neaktivan</span>
                                <span class="badge bg-blue-lt text-blue"><i class="ti ti-shield me-1"></i>Admin</span>
                                <span class="badge bg-orange-lt text-orange"><i class="ti ti-clock me-1"></i>Na čekanju</span>
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="col-md-6" id="avatars">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-user-circle me-2"></i>Avatari</h3>
                                <div class="card-options"><code class="text-secondary small">avatar</code></div>
                            </x-slot>

                            <p class="text-secondary mb-2">Veličine</p>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="avatar avatar-xl bg-primary text-white">XL</span>
                                <span class="avatar avatar-lg bg-green text-white">LG</span>
                                <span class="avatar bg-orange text-white">MD</span>
                                <span class="avatar avatar-sm bg-purple text-white">SM</span>
                                <span class="avatar avatar-xs bg-red text-white">XS</span>
                            </div>

                            <p class="text-secondary mb-2">S ikonama (light boja)</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="avatar bg-red-lt text-red"><i class="ti ti-shield-lock"></i></span>
                                <span class="avatar bg-blue-lt text-blue"><i class="ti ti-user"></i></span>
                                <span class="avatar bg-green-lt text-green"><i class="ti ti-check"></i></span>
                                <span class="avatar bg-orange-lt text-orange"><i class="ti ti-activity"></i></span>
                                <span class="avatar bg-purple-lt text-purple"><i class="ti ti-settings"></i></span>
                                <span class="avatar bg-cyan-lt text-cyan"><i class="ti ti-file-text"></i></span>
                            </div>

                            <p class="text-secondary mb-2">U listi korisnika</p>
                            <div class="d-flex flex-column gap-2">
                                @foreach([['IH', 'bg-primary', 'Ivan Horvat', 'Administrator'], ['AK', 'bg-green', 'Ana Kovač', 'Korisnik'], ['MM', 'bg-orange', 'Marko Marić', 'Korisnik']] as $item)
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-sm {{ $item[1] }} text-white">{{ $item[0] }}</span>
                                        <div>
                                            <div class="fw-medium">{{ $item[2] }}</div>
                                            <div class="text-secondary small">{{ $item[3] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 5. FORME ===== --}}
                <div class="row row-deck row-cards mb-4" id="forms">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-forms me-2"></i>Forme i inputi</h3>
                                <div class="card-options"><code class="text-secondary small">x-ui.form-input</code></div>
                            </x-slot>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <p class="text-secondary mb-3">Tipovi inputa</p>

                                    <x-ui.form-input
                                        name="sc_text"
                                        label="Text input"
                                        placeholder="Unesite tekst"
                                        icon="ti ti-abc"
                                    />
                                    <x-ui.form-input
                                        name="sc_email"
                                        type="email"
                                        label="Email (obavezan)"
                                        placeholder="vas@email.com"
                                        icon="ti ti-mail"
                                        :required="true"
                                    />
                                    <x-ui.form-input
                                        name="sc_password"
                                        type="password"
                                        label="Password"
                                        placeholder="••••••••"
                                        icon="ti ti-lock"
                                    />
                                    <x-ui.form-input
                                        name="sc_tel"
                                        type="tel"
                                        label="Telefon"
                                        placeholder="+385 99 123 4567"
                                        icon="ti ti-phone"
                                        hint="Format: +385 99 123 4567"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <p class="text-secondary mb-3">Stanja inputa</p>

                                    <x-ui.form-input
                                        name="sc_hint"
                                        label="S hint tekstom"
                                        placeholder="Username"
                                        icon="ti ti-user"
                                        hint="Min. 3 znaka, samo slova i brojevi"
                                    />
                                    <x-ui.form-input
                                        name="sc_error"
                                        label="S greškom"
                                        value="pogrešan_unos!"
                                        icon="ti ti-alert-circle"
                                        error="Ovo polje sadrži nedozvoljene znakove."
                                    />
                                    <x-ui.form-input
                                        name="sc_date"
                                        type="date"
                                        label="Datum"
                                        icon="ti ti-calendar"
                                    />
                                    <x-ui.form-input
                                        name="sc_number"
                                        type="number"
                                        label="Broj"
                                        placeholder="0"
                                        icon="ti ti-hash"
                                        hint="Unesite cijeli broj"
                                    />
                                </div>

                                {{-- Ostali form elementi --}}
                                <div class="col-md-4">
                                    <label class="form-label">Select</label>
                                    <select class="form-select">
                                        <option value="">Odaberi...</option>
                                        <option>Admin</option>
                                        <option>Korisnik</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Textarea</label>
                                    <textarea class="form-control" rows="3" placeholder="Unesite tekst..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Checkboxi i radio</label>
                                    <div class="mb-2">
                                        <label class="form-check"><input type="checkbox" class="form-check-input" checked><span class="form-check-label">Checkbox 1</span></label>
                                        <label class="form-check"><input type="checkbox" class="form-check-input"><span class="form-check-label">Checkbox 2</span></label>
                                    </div>
                                    <label class="form-check"><input type="radio" class="form-check-input" name="r" checked><span class="form-check-label">Radio A</span></label>
                                    <label class="form-check"><input type="radio" class="form-check-input" name="r"><span class="form-check-label">Radio B</span></label>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 6. TABLICA ===== --}}
                <div class="row row-deck row-cards mb-4" id="table">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-table me-2"></i>Tablica</h3>
                                <div class="card-options"><code class="text-secondary small">x-ui.table</code></div>
                            </x-slot>

                            <x-ui.table :headers="['Korisnik', 'Email', 'Uloga', 'Status', 'Akcije']" :hoverable="true">
                                @foreach([
                                    ['IH', 'bg-primary', 'Ivan Horvat', 'ivan@example.com', 'Admin', 'red', 'aktivan'],
                                    ['AK', 'bg-green', 'Ana Kovač', 'ana@example.com', 'Korisnik', 'blue', 'aktivan'],
                                    ['MM', 'bg-orange', 'Marko Marić', 'marko@example.com', 'Korisnik', 'blue', 'neaktivan'],
                                    ['PN', 'bg-purple', 'Petra Novak', 'petra@example.com', 'Korisnik', 'blue', 'aktivan'],
                                ] as $row)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="avatar avatar-sm {{ $row[1] }} text-white">{{ $row[0] }}</span>
                                                <div class="fw-medium">{{ $row[2] }}</div>
                                            </div>
                                        </td>
                                        <td class="text-secondary">{{ $row[3] }}</td>
                                        <td><span class="badge bg-{{ $row[5] }}-lt text-{{ $row[5] }}">{{ $row[4] }}</span></td>
                                        <td>
                                            @if($row[6] === 'aktivan')
                                                <span class="badge bg-success"><i class="ti ti-check me-1"></i>Aktivan</span>
                                            @else
                                                <span class="badge bg-secondary">Neaktivan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <x-ui.button variant="primary" size="sm" icon="ti ti-edit">Uredi</x-ui.button>
                                                <x-ui.button variant="danger" size="sm" :outline="true">
                                                    <i class="ti ti-trash"></i>
                                                </x-ui.button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-ui.table>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 7. MODALI ===== --}}
                <div class="row row-deck row-cards mb-4" id="modals">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-layout-navbar me-2"></i>Modali</h3>
                                <div class="card-options"><code class="text-secondary small">x-ui.modal</code></div>
                            </x-slot>

                            <div class="btn-list">
                                <x-ui.button variant="primary" data-bs-toggle="modal" data-bs-target="#scModalBasic">
                                    Osnovni modal
                                </x-ui.button>
                                <x-ui.button variant="success" data-bs-toggle="modal" data-bs-target="#scModalConfirm">
                                    Potvrda akcije
                                </x-ui.button>
                                <x-ui.button variant="secondary" data-bs-toggle="modal" data-bs-target="#scModalLarge" icon="ti ti-maximize">
                                    Veliki modal (lg)
                                </x-ui.button>
                                <x-ui.button variant="warning" data-bs-toggle="modal" data-bs-target="#scModalForm" icon="ti ti-user-plus">
                                    Modal s formom
                                </x-ui.button>
                                <x-ui.button variant="danger" :outline="true" data-bs-toggle="modal" data-bs-target="#scModalStatic">
                                    Static modal
                                </x-ui.button>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 8. TABLER BOJE ===== --}}
                <div class="row row-deck row-cards mb-4" id="colors">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-palette me-2"></i>Tabler boje</h3>
                                <div class="card-options"><code class="text-secondary small">bg-* / text-*</code></div>
                            </x-slot>

                            <div class="row g-2">
                                @foreach([
                                    ['bg-blue', 'Blue'],
                                    ['bg-azure', 'Azure'],
                                    ['bg-indigo', 'Indigo'],
                                    ['bg-purple', 'Purple'],
                                    ['bg-pink', 'Pink'],
                                    ['bg-red', 'Red'],
                                    ['bg-orange', 'Orange'],
                                    ['bg-yellow', 'Yellow'],
                                    ['bg-lime', 'Lime'],
                                    ['bg-green', 'Green'],
                                    ['bg-teal', 'Teal'],
                                    ['bg-cyan', 'Cyan'],
                                ] as $color)
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <div class="{{ $color[0] }} text-white rounded p-3 text-center">
                                            <div class="fw-bold">{{ $color[1] }}</div>
                                            <div class="small opacity-75">{{ $color[0] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-3">
                            <p class="text-secondary mb-2">Light varijante (<code>-lt</code>) — za pozadine i avatare</p>
                            <div class="row g-2">
                                @foreach([
                                    ['bg-blue-lt', 'text-blue', 'Blue lt'],
                                    ['bg-red-lt', 'text-red', 'Red lt'],
                                    ['bg-green-lt', 'text-green', 'Green lt'],
                                    ['bg-orange-lt', 'text-orange', 'Orange lt'],
                                    ['bg-purple-lt', 'text-purple', 'Purple lt'],
                                    ['bg-cyan-lt', 'text-cyan', 'Cyan lt'],
                                    ['bg-yellow-lt', 'text-yellow', 'Yellow lt'],
                                    ['bg-pink-lt', 'text-pink', 'Pink lt'],
                                ] as $color)
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <div class="{{ $color[0] }} {{ $color[1] }} rounded p-3 text-center">
                                            <div class="fw-bold">{{ $color[2] }}</div>
                                            <div class="small opacity-75">{{ $color[0] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                {{-- ===== 9. IKONE ===== --}}
                <div class="row row-deck row-cards mb-4" id="icons">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title"><i class="ti ti-icons me-2"></i>Tabler ikone (česti primjeri)</h3>
                                <div class="card-options">
                                    <a href="https://tabler-icons.io" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        Sve ikone <i class="ti ti-external-link ms-1"></i>
                                    </a>
                                </div>
                            </x-slot>

                            @php
                            $iconGroups = [
                                'Korisnici' => ['ti-user', 'ti-users', 'ti-user-plus', 'ti-user-check', 'ti-user-edit', 'ti-user-x', 'ti-user-circle'],
                                'Navigacija' => ['ti-home', 'ti-dashboard', 'ti-settings', 'ti-menu', 'ti-arrow-left', 'ti-arrow-right', 'ti-logout', 'ti-login'],
                                'Akcije' => ['ti-plus', 'ti-edit', 'ti-trash', 'ti-download', 'ti-upload', 'ti-search', 'ti-check', 'ti-x'],
                                'Status' => ['ti-alert-circle', 'ti-alert-triangle', 'ti-info-circle', 'ti-check-circle', 'ti-shield-check', 'ti-shield-lock'],
                                'Datoteke' => ['ti-file', 'ti-file-text', 'ti-file-invoice', 'ti-folder', 'ti-photo', 'ti-database', 'ti-server'],
                                'Komunikacija' => ['ti-mail', 'ti-phone', 'ti-message', 'ti-bell', 'ti-send'],
                                'Poslovanje' => ['ti-shopping-cart', 'ti-credit-card', 'ti-chart-line', 'ti-receipt', 'ti-currency-euro'],
                            ];
                            @endphp

                            @foreach($iconGroups as $group => $icons)
                                <p class="text-secondary mb-2">{{ $group }}</p>
                                <div class="d-flex flex-wrap gap-3 mb-4">
                                    @foreach($icons as $icon)
                                        <div class="d-flex flex-column align-items-center gap-1" style="min-width: 56px;">
                                            <span class="avatar bg-secondary-lt">
                                                <i class="ti {{ $icon }} fs-3"></i>
                                            </span>
                                            <code class="text-secondary" style="font-size: 0.65rem;">{{ $icon }}</code>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </x-ui.card>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        {{-- Modali --}}
        <x-ui.modal id="scModalBasic" title="Osnovni modal">
            <p>Ovo je jednostavan modal s naslovom i sadržajem. Zatvara se klikom na X ili izvan modala.</p>
        </x-ui.modal>

        <x-ui.modal id="scModalConfirm" title="Potvrdi akciju">
            <p>Jesi li siguran/na da želiš nastaviti? Ova akcija se ne može poništiti.</p>
            <x-slot name="footer">
                <x-ui.button variant="secondary" data-bs-dismiss="modal">Odustani</x-ui.button>
                <x-ui.button variant="danger" icon="ti ti-trash">Da, obriši</x-ui.button>
            </x-slot>
        </x-ui.modal>

        <x-ui.modal id="scModalLarge" title="Veliki modal s više sadržaja" size="lg">
            <div class="row g-3">
                <div class="col-md-6">
                    <h4>Lijeva strana</h4>
                    <p class="text-secondary">Veliki modal je koristan za prikaz više informacija ili složenijih formi.</p>
                    <x-ui.alert type="info">Napomena za korisnika.</x-ui.alert>
                </div>
                <div class="col-md-6">
                    <h4>Desna strana</h4>
                    <x-ui.table :headers="['Ključ', 'Vrijednost']">
                        <tr><td>Verzija</td><td><span class="badge bg-blue">Laravel 12</span></td></tr>
                        <tr><td>Baza</td><td><span class="badge bg-blue-lt text-blue">PostgreSQL</span></td></tr>
                        <tr><td>UI</td><td><span class="badge bg-green-lt text-green">Tabler 1.4</span></td></tr>
                    </x-ui.table>
                </div>
            </div>
            <x-slot name="footer">
                <x-ui.button variant="secondary" data-bs-dismiss="modal">Zatvori</x-ui.button>
                <x-ui.button variant="primary">Spremi</x-ui.button>
            </x-slot>
        </x-ui.modal>

        <x-ui.modal id="scModalForm" title="Dodaj novog korisnika" size="lg">
            <form id="scUserForm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-ui.form-input name="sc_mname" label="Ime i prezime" placeholder="Ivan Horvat" icon="ti ti-user" :required="true" />
                    </div>
                    <div class="col-md-6">
                        <x-ui.form-input name="sc_memail" type="email" label="Email" placeholder="ivan@example.com" icon="ti ti-mail" :required="true" />
                    </div>
                    <div class="col-md-6">
                        <x-ui.form-input name="sc_mphone" type="tel" label="Telefon" placeholder="+385 99 000 0000" icon="ti ti-phone" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Uloga</label>
                        <select name="sc_mrole" class="form-select">
                            <option value="user">Korisnik</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                </div>
            </form>
            <x-slot name="footer">
                <x-ui.button variant="secondary" data-bs-dismiss="modal">Odustani</x-ui.button>
                <x-ui.button variant="primary" icon="ti ti-user-plus" type="submit" form="scUserForm">Kreiraj korisnika</x-ui.button>
            </x-slot>
        </x-ui.modal>

        <x-ui.modal id="scModalStatic" title="Važna poruka" :static="true">
            <x-ui.alert type="warning">
                <strong>Pažnja!</strong> Ovo je static modal — ne zatvara se klikom izvan prozora.
            </x-ui.alert>
            <p class="mb-0">Korisno za važne poruke koje korisnik mora eksplicitno potvrditi.</p>
            <x-slot name="footer">
                <x-ui.button variant="primary" data-bs-dismiss="modal" icon="ti ti-check">Razumijem</x-ui.button>
            </x-slot>
        </x-ui.modal>
    </x-slot>
</x-layouts.app>
