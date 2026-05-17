# RBAC — Role-Based Access Control

Implementacija autentikacije i autorizacije u Laravel 12 projektu koristeći **spatie/laravel-permission**.

---

## Uloge (Roles)

| Uloga   | Opis                                      |
|---------|-------------------------------------------|
| `admin` | Pristup admin panelu, upravljanje korisnicima |
| `user`  | Pristup korisničkom dashboardu i profilu  |

Uloge se kreiraju i dodjeljuju u [`database/seeders/RoleSeeder.php`](database/seeders/RoleSeeder.php).

### Test korisnici (seeder)

| Email                  | Lozinka    | Uloga  |
|------------------------|------------|--------|
| `admin@example.com`    | `password` | admin  |
| `user@example.com`     | `password` | user   |
| 10 factory korisnika   | `password` | user   |

---

## Struktura datoteka

```
app/
├── Http/Controllers/
│   ├── AuthController.php            ← login, register, logout, redirectByRole
│   ├── Admin/
│   │   └── AdminController.php       ← dashboard, users, updateUser, assignRole
│   └── User/
│       └── UserController.php        ← dashboard, updateProfile
├── Models/
│   └── User.php                      ← HasRoles trait
└── Providers/
    └── AppServiceProvider.php        ← LogViewer::auth() — samo admini

bootstrap/
└── app.php                           ← middleware aliasi (role, permission)

database/seeders/
├── RoleSeeder.php                    ← kreiranje uloga i test korisnika
└── DatabaseSeeder.php                ← poziva RoleSeeder + factory useri

routes/
└── web.php                           ← rute grupirane po middleware zaštiti

resources/views/
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── admin/
│   ├── dashboard.blade.php
│   └── users/index.blade.php
├── user/
│   └── dashboard.blade.php
├── components/layouts/
│   ├── auth.blade.php                ← centered layout za login/register
│   ├── landing.blade.php             ← layout za welcome stranicu
│   └── app.blade.php                 ← glavni layout (sidebar + navbar)
├── errors/
│   ├── minimal.blade.php             ← bazni error layout
│   ├── 401, 403, 404, 419, 429, 500, 503 .blade.php
└── welcome.blade.php
```

---

## Middleware i zaštita ruta

### Registracija aliasa — `bootstrap/app.php`

```php
$middleware->alias([
    'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
]);
```

### Rute — `routes/web.php`

```php
// Javno dostupno
Route::get('/', ...)                         // gosti → welcome, prijavljeni → redirect po roli
Route::get('/showcase', ...)                 // UI showcase

// Samo gosti
Route::middleware('guest')->group(function () {
    Route::get('/login', ...)->name('login');
    Route::post('/login', ...)->name('login.post');
    Route::get('/register', ...)->name('register');
    Route::post('/register', ...)->name('register.post');
});

// Prijavljeni (auth)
Route::post('/logout', ...)->name('logout')->middleware('auth');

// Korisnici (auth + role:user|admin)
Route::middleware(['auth', 'role:user|admin'])->group(function () {
    Route::get('/dashboard', ...)->name('user.dashboard');
    Route::put('/profile', ...)->name('user.profile.update');
});

// Admin panel (auth + role:admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', ...)->name('dashboard');
    Route::get('/users', ...)->name('users');
    Route::put('/users/{user}', ...)->name('users.update');
    Route::put('/users/{user}/role', ...)->name('users.assign-role');
});
```

---

## AuthController

**Datoteka:** `app/Http/Controllers/AuthController.php`

| Metoda          | Opis                                                      |
|-----------------|-----------------------------------------------------------|
| `showLogin`     | Prikazuje login formu                                     |
| `login`         | Validacija + `Auth::attempt` + redirect po roli           |
| `showRegister`  | Prikazuje register formu                                  |
| `register`      | Kreiranje korisnika + `assignRole('user')` + auto-login   |
| `logout`        | `Auth::logout` + redirect na `/`                          |
| `redirectByRole`| admin → `admin.dashboard`, ostali → `user.dashboard`     |

---

## AdminController

**Datoteka:** `app/Http/Controllers/Admin/AdminController.php`

| Metoda        | Ruta                         | Opis                                          |
|---------------|------------------------------|-----------------------------------------------|
| `dashboard`   | `GET /admin/dashboard`       | Statistike + recentActivities (activitylog)   |
| `users`       | `GET /admin/users`           | Paginirana lista korisnika s ulogama          |
| `updateUser`  | `PUT /admin/users/{user}`    | Ažuriranje ime/email + activity log zapis     |
| `assignRole`  | `PUT /admin/users/{user}/role` | Sync uloge + activity log zapis             |

---

## UserController

**Datoteka:** `app/Http/Controllers/User/UserController.php`

| Metoda          | Ruta               | Opis                                                 |
|-----------------|--------------------|------------------------------------------------------|
| `dashboard`     | `GET /dashboard`   | Stat kartice + aktivnosti `causedBy($user)`          |
| `updateProfile` | `PUT /profile`     | Ime, email, lozinka (nullable) + activity log zapis  |

---

## Blade direktive (Spatie)

```blade
@role('admin')
    {{-- Prikazuje se samo adminima --}}
@endrole

@role('user')
    {{-- Prikazuje se samo korisnicima --}}
@endrole

@hasrole('admin')
    {{-- Alternativna direktiva --}}
@endhasrole

{{-- U PHP kodu --}}
auth()->user()->hasRole('admin')
auth()->user()->getRoleNames()   {{-- Collection s imenima uloga --}}
```

---

## Log Viewer pristup

**Datoteka:** `app/Providers/AppServiceProvider.php`

```php
LogViewer::auth(function ($request) {
    return $request->user()?->hasRole('admin') ?? false;
});
```

**Datoteka:** `config/log-viewer.php`

```php
'api_middleware' => [
    'web',   // ← NE EnsureFrontendRequestsAreStateful (nema session bez tog)
    \Opcodes\LogViewer\Http\Middleware\AuthorizeLogViewer::class,
],
```

URL: `https://laravel-postgresql-demo.test/log-viewer`

---

## Pokretanje seedera

```bash
php artisan migrate:fresh --seed
```

ili samo seeder:

```bash
php artisan db:seed --class=RoleSeeder
```

---

## MCP serveri

Projekt koristi dva MCP servera za Claude integraciju.

### 1. Laravel Boost MCP (razvojni alati)

Ugrađen u Laravel projekt. Pruža alate za razvoj:
`database-query`, `database-schema`, `tinker`, `list-routes`, `read-log-entries`, `browser-logs`, `application-info`

```bash
php artisan boost:mcp   # pokretanje
```

### 2. laravel-demo-mcp (poslovna logika)

Standalone PHP MCP server u `C:\laragon\www\laravel-demo-mcp\`.
Pruža CRUD operacije nad korisnicima, ulogama i activity logom.

**Tools:** `get_users`, `get_user`, `create_user`, `update_user`, `assign_role`, `delete_user`, `get_activities`, `get_stats`
**Resources:** `users://list`, `users://{id}`, `roles://list`, `activity://recent`, `config://app`
**Prompts:** `user_report`, `audit_log`

### Konfiguracija u Claude Desktopu

Datoteka: `C:\Users\mkopc\AppData\Roaming\Claude\claude_desktop_config.json`

```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "php",
      "args": ["C:\\laragon\\www\\laravel-postgresql-demo\\artisan", "boost:mcp"]
    },
    "laravel-demo-mcp": {
      "command": "php",
      "args": ["C:\\laragon\\www\\laravel-demo-mcp\\server.php"]
    }
  }
}
```

> Nakon promjene config datoteke potrebno je **restartati Claude Desktop**.
