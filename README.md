# Laravel 12 + PostgreSQL + Tabler Admin

Profesionalno strukturiran Laravel 12 projekt s PostgreSQL bazom podataka i Tabler Admin UI frameworkom.

## 📋 Sadržaj

- [O projektu](#o-projektu)
- [Tehnologije](#tehnologije)
- [Instalirani Paketi](#instalirani-paketi)
- [RBAC — Autentikacija i autorizacija](#rbac--autentikacija-i-autorizacija)
- [MCP Serveri](#mcp-serveri)
- [Struktura projekta](#struktura-projekta)
- [Instalacija](#instalacija)
- [Tabler Layout Sistem](#tabler-layout-sistem)
- [UI Komponente](#ui-komponente)
- [Primjeri korištenja](#primjeri-korištenja)
- [PostgreSQL Konfiguracija](#postgresql-konfiguracija)

## 🎯 O projektu

Čist Laravel 12 projekt bez starter kitova, s ručno integriranim Tabler Admin UI frameworkom. Projekt je profesionalno strukturiran i spreman za razvoj SaaS aplikacija ili admin panela.

## 🚀 Tehnologije

- **Laravel 12** - PHP framework
- **PostgreSQL** - Relacijska baza podataka
- **Tabler 1.4.0** - Premium & Open Source dashboard template
- **Tabler Icons** - Icon library
- **Bootstrap 5** - CSS framework (uključen u Tabler)

## � Instalirani Paketi

### Development Paketi

- **Laravel Debugbar** `v4.0.10` - Debugging toolbar za vrijeme razvoja
- **Laravel Boost** `v2.2.1` - AI-powered Laravel assistant

### Production Paketi

- **Opcodesio Log Viewer** `v3.23.0` - Pregled Laravel log fileova preko web sučelja
    - URL: `/log-viewer`
    - Konfig: `config/log-viewer.php`

- **Spatie Laravel Backup** `v10.0.1` - Automatski backupi aplikacije i baze
    - Konfig: `config/backup.php`
    - Komande: `php artisan backup:run`, `backup:list`, `backup:clean`

- **Spatie Media Library** `v11.21.0` - Upravljanje medijskim fileovima
    - Konfig: `config/media-library.php`
    - Migracija: `create_media_table`

- **Spatie Activity Log** `v4.12.1` - Praćenje aktivnosti korisnika
    - Konfig: `config/activitylog.php`
    - Migracije: `create_activity_log_table`, `add_event_column`, `add_batch_uuid_column`

- **Spatie Laravel Permission** `v7.2.3` - Upravljanje rolama i dozvolama
    - Konfig: `config/permission.php`
    - Migracija: `create_permission_tables`

## 🔐 RBAC — Autentikacija i autorizacija

Implementirano s **spatie/laravel-permission**. Detaljna dokumentacija u [`RBAC.md`](RBAC.md).

### Uloge i test korisnici

| Email | Lozinka | Uloga |
|-------|---------|-------|
| `admin@example.com` | `password` | admin |
| `user@example.com` | `password` | user |

### Brzi pregled ruta

| URL | Middleware | Opis |
|-----|-----------|------|
| `/` | — | Landing page (gosti) / redirect (prijavljeni) |
| `/login`, `/register` | `guest` | Autentikacija |
| `/dashboard` | `auth, role:user\|admin` | Korisnički dashboard |
| `/admin/dashboard` | `auth, role:admin` | Admin panel |
| `/admin/users` | `auth, role:admin` | Upravljanje korisnicima |
| `/log-viewer` | `auth, role:admin` | Laravel Log Viewer |
| `/showcase` | — | UI komponente showcase |

```bash
# Pokreni migracije i seedere (kreira test korisnike i uloge)
php artisan migrate:fresh --seed
```

---

## 📁 Struktura projekta

### Blade Komponente

```
resources/views/components/
├── layouts/
│   └── app.blade.php              # Master layout komponenta
├── navbar.blade.php                # Top navigation bar
├── sidebar.blade.php               # Side menu (horizontal nav)
└── ui/
    ├── alert.blade.php             # Alert komponenta
    ├── button.blade.php            # Button komponenta
    ├── card.blade.php              # Card komponenta
    ├── form-input.blade.php        # Form input komponenta
    ├── modal.blade.php             # Modal dialog komponenta
    └── table.blade.php             # Table komponenta
```

### Tabler Assets

```
public/tabler/
└── dist/
    ├── css/
    │   ├── tabler.min.css          # Glavni CSS
    │   ├── tabler-flags.min.css    # Zastave
    │   ├── tabler-payments.min.css # Payment ikone
    │   └── tabler-vendors.min.css  # Vendor CSS
    ├── js/
    │   ├── tabler.min.js           # Glavni JS
    │   └── tabler-theme.min.js     # Theme switcher
    ├── libs/                       # Dodatne biblioteke
    └── img/                        # Slike i ikone
```

## 🛠️ Instalacija

### 1. Kloniraj i instaliraj dependencies

```bash
# Kloniraj repozitorij
git clone <repository-url>
cd laravel-postgresql-demo

# Instaliraj Composer dependencies
composer install

# Kopiraj .env file
cp .env.example .env

# Generiraj app key
php artisan key:generate
```

### 2. PostgreSQL Setup

Kreiraj PostgreSQL bazu podataka:

```sql
CREATE DATABASE postgresql_test;
```

Ažuriraj `.env` datoteku:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgresql_test
DB_USERNAME=postgres
DB_PASSWORD=tvoj_password
```

### 3. Migration

```bash
# Pokreni migracijske datoteke
php artisan migrate

# (Opcionalno) Seed bazu s testnim podatcima
php artisan db:seed
```

### 4. Pokreni development server

```bash
php artisan serve
```

Otvori browser na `http://localhost:8000`

## 📚 Dokumentacija

Svi projektni dokumenti se nalaze u `docs/technical`:

- `docs/technical/redis-cache.md`
- `docs/technical/POSTGRESQL-SETUP.md`
- `docs/technical/QUICK-REFERENCE.md`
- `docs/technical/TABLER-COMPONENTS.md`
- `docs/technical/laravel-ai-stack.md`

## 🎨 Tabler Layout Sistem

### Master Layout

Glavni layout se nalazi u `resources/views/components/layouts/app.blade.php` i uključuje:

- Tabler CSS i JS fileove iz `public/tabler/dist/`
- Tabler Icons CDN
- Dinamički `title` tag
- Slotove za `head` i `scripts`

### Korištenje Master Layouta

```blade
<x-layouts.app title="Dashboard">
    <x-slot name="head">
        <!-- Dodatni head sadržaj -->
    </x-slot>

    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <!-- Tvoj sadržaj -->
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <!-- Dodatni JS -->
    </x-slot>
</x-layouts.app>
```

## 🧩 UI Komponente

### 1. Card Komponenta

```blade
<x-ui.card>
    <x-slot name="header">
        <h3 class="card-title">Naslov</h3>
    </x-slot>

    Sadržaj card-a

    <x-slot name="footer">
        Footer sadržaj
    </x-slot>
</x-ui.card>
```

### 2. Alert Komponenta

```blade
<!-- Success alert -->
<x-ui.alert type="success" :dismissible="true">
    <strong>Odlično!</strong> Uspješno izvršena akcija.
</x-ui.alert>

<!-- Tipovi: info, success, warning, danger -->
<x-ui.alert type="warning">
    Upozorenje!
</x-ui.alert>

<!-- S custom ikonom -->
<x-ui.alert type="info" icon="ti ti-star">
    Info poruka
</x-ui.alert>
```

### 3. Button Komponenta

```blade
<!-- Primary button -->
<x-ui.button variant="primary">
    Klikni me
</x-ui.button>

<!-- Button s ikonom -->
<x-ui.button variant="success" icon="ti ti-plus">
    Dodaj novi
</x-ui.button>

<!-- Outline button -->
<x-ui.button variant="danger" :outline="true">
    Obriši
</x-ui.button>

<!-- Veličine: sm, lg -->
<x-ui.button variant="primary" size="lg">
    Veliki button
</x-ui.button>

<!-- Varijante: primary, secondary, success, warning, danger, info, light, dark -->
```

### 4. Form Input Komponenta

```blade
<x-ui.form-input
    name="email"
    type="email"
    label="Email adresa"
    placeholder="email@primjer.com"
    icon="ti ti-mail"
    :required="true"
    hint="Koristite vašu poslovnu email adresu"
/>

<!-- S error porukom -->
<x-ui.form-input
    name="phone"
    label="Telefon"
    error="Telefon je obavezan"
/>
```

### 5. Table Komponenta

```blade
<x-ui.table :headers="['ID', 'Ime', 'Email', 'Status']" :striped="true">
    <tr>
        <td>1</td>
        <td>Ivan Horvat</td>
        <td>ivan@example.com</td>
        <td><span class="badge bg-success">Aktivan</span></td>
    </tr>
    <tr>
        <td>2</td>
        <td>Ana Kovač</td>
        <td>ana@example.com</td>
        <td><span class="badge bg-warning">Na čekanju</span></td>
    </tr>
</x-ui.table>
```

### 6. Modal Komponenta

```blade
<!-- Button za otvaranje modala -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Otvori modal
</button>

<!-- Modal -->
<x-ui.modal id="myModal" title="Naslov modala" size="lg">
    <p>Sadržaj modala...</p>

    <x-slot name="footer">
        <x-ui.button variant="secondary" data-bs-dismiss="modal">
            Zatvori
        </x-ui.button>
        <x-ui.button variant="primary">
            Spremi
        </x-ui.button>
    </x-slot>
</x-ui.modal>

<!-- Static modal (ne zatvara se klikom van) -->
<x-ui.modal id="importantModal" title="Važno" :static="true">
    Ovo je važna poruka!
</x-ui.modal>
```

## 📖 Primjeri korištenja

### Tipična Admin Stranica

```blade
<x-layouts.app title="Korisnici - Admin Panel">
    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Korisnici</h2>
                        <div class="text-secondary mt-1">
                            Pregled svih korisnika u sistemu
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <x-ui.button variant="primary" icon="ti ti-plus">
                            Dodaj korisnika
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Body -->
        <div class="page-body">
            <div class="container-xl">
                <x-ui.card>
                    <x-ui.table :headers="['ID', 'Ime', 'Email', 'Status', 'Akcije']">
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-success">Aktivan</span>
                            </td>
                            <td>
                                <x-ui.button variant="primary" size="sm">
                                    Uredi
                                </x-ui.button>
                            </td>
                        </tr>
                        @endforeach
                    </x-ui.table>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layouts.app>
```

### Dashboard s Karticama

```blade
<x-layouts.app title="Dashboard">
    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <!-- Stats Cards -->
                <div class="row row-deck row-cards">
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
                    <!-- Više kartica... -->
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
```

## 💾 PostgreSQL Konfiguracija

Projekt koristi PostgreSQL kao primarnu bazu podataka. Konfiguracija se nalazi u `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgresql_test
DB_USERNAME=postgres
DB_PASSWORD=
```

### PostgreSQL Korisni Commandovi

```bash
# Kreiraj novu bazu
createdb postgresql_test

# Povezivanje na bazu
psql -U postgres -d postgresql_test

# Drop baze
dropdb postgresql_test

# Backup baze
pg_dump postgresql_test > backup.sql

# Restore baze
psql postgresql_test < backup.sql
```

### Laravel Migracije

```bash
# Pokreni sve migracijske datoteke
php artisan migrate

# Rollback zadnje migracije
php artisan migrate:rollback

# Reset sve migracije i pokreni ih iznova
php artisan migrate:fresh

# Fresh migracije s seedom
php artisan migrate:fresh --seed
```

## 📚 Dodatni resursi

### Laravel

- [Laravel Dokumentacija](https://laravel.com/docs)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Blade Komponente](https://laravel.com/docs/blade#components)

### Tabler

- [Tabler Documentation](https://tabler.io/docs)
- [Tabler Icons](https://tabler-icons.io/)
- [Tabler Examples](https://preview.tabler.io/)

### PostgreSQL

- [PostgreSQL Dokumentacija](https://www.postgresql.org/docs/)
- [Laravel PostgreSQL](https://laravel.com/docs/database#postgresql)

## 🤝 Doprinos

Za doprinose projektu:

1. Fork projekta
2. Kreiraj feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit promjene (`git commit -m 'Add some AmazingFeature'`)
4. Push na branch (`git push origin feature/AmazingFeature`)
5. Otvori Pull Request

## 📝 License

Ovaj projekt je open-source i dostupan pod [MIT licencom](https://opensource.org/licenses/MIT).

## 👨‍💻 Autor

Izrađeno s ❤️ za profesionalni razvoj Laravel aplikacija.
