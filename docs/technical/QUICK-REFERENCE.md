# 🚀 PostgreSQL + Laravel - Quick Reference

**PHP Verzija:** 8.3.30 ✅  
**PostgreSQL:** 16.6   
**Laravel:** 12.53.0

---

## ⚡ Najčešće Korištene Komande

### PostgreSQL Server

```powershell
# START
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" -l "C:\laragon\data\postgresql\server.log" start

# STOP
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" stop

# STATUS
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" status

# RESTART
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" restart
```

**Ili koristi batch skripte:**
- `C:\laragon\bin\postgresql\start-postgresql.bat`
- `C:\laragon\bin\postgresql\stop-postgresql.bat`
- `C:\laragon\bin\postgresql\status-postgresql.bat`

---

### psql Konekcija

```bash
# Connect to database
psql -U postgres -d postgresql_test

# Or use batch script
C:\laragon\bin\postgresql\psql-connect.bat
```

---

### Laravel Migracije

```bash
cd C:\laragon\www\laravel-postgresql-demo

php artisan migrate          # Run migrations  
php artisan migrate:fresh    # Drop all tables and re-migrate
php artisan migrate:rollback # Rollback last migration
php artisan migrate:status   # Check migration status
```

---

### PostgreSQL Admin

```bash
# Create database
createdb -U postgres ime_baze

# Drop database
dropdb -U postgres ime_baze

# List databases
psql -U postgres -c "\l"

# List tables in database
psql -U postgres -d postgresql_test -c "\dt"

# Backup
pg_dump -U postgres -d postgresql_test -f backup.sql

# Restore
psql -U postgres -d postgresql_test -f backup.sql
```

---

### psql Commands (Inside psql)

```sql
\l              -- List all databases
\c dbname       -- Connect to database
\dt             -- List tables
\d+ table_name  -- Table details
\du             -- List users
\dx             -- List extensions
\q              -- Quit
```

---

## 🔐 Login Podaci

```
Host:     127.0.0.1
Port:     5432
Username: postgres
Password: (prazno)
Database: postgresql_test
```

**Connection String:**
```
postgresql://postgres@localhost:5432/postgresql_test
```

---

## 🌐 URLs

```
HTTP:  http://laravel-postgresql-demo.test
HTTPS: https://laravel-postgresql-demo.test
```

---

## 🛠️ Ako Nešto Ne Radi

### 1. Provjeri Server Status
```powershell
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" status
```

### 2. Provjeri PHP Verziju
```powershell
php -v   # MORA biti 8.3.30, NE 8.5.x!
```

### 3. Provjeri PostgreSQL Ekstenzije
```powershell
php -m | Select-String "pdo_pgsql|pgsql"
```

### 4. Provjeri Port 5432
```powershell
Test-NetConnection -ComputerName localhost -Port 5432
```

### 5. Pogledaj Log
```powershell
Get-Content "C:\laragon\data\postgresql\server.log" -Tail 50
```

### 6. Laravel Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📁 Važne Lokacije

| Šta | Gdje |
|-----|------|
| PostgreSQL Binaries | `C:\laragon\bin\postgresql\pgsql\bin\` |
| PostgreSQL Data | `C:\laragon\data\postgresql\` |
| PostgreSQL Config | `C:\laragon\data\postgresql\postgresql.conf` |
| Laravel Project | `C:\laragon\www\laravel-postgresql-demo\` |
| Laravel .env | `C:\laragon\www\laravel-postgresql-demo\.env` |
| PHP 8.3.30 ini | `C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.ini` |
| Apache VHost | `C:\laragon\etc\apache2\sites-enabled\auto.laravel-postgresql-demo.test.conf` |

---

## 🔄 Prebacivanje PHP Verzije

**⚠️ VAŽNO:** Ako koristiš PHP 8.5.x, Laravel će pucati zbog Carbon greške.

1. Laragon Tray Icon → Desni Klik
2. PHP → Version → **php-8.3.30**
3. Laragon restartuje Apache automatski
4. Terminal:
```powershell
cd C:\laragon\www\laravel-postgresql-demo
Remove-Item composer.lock -Force
composer update
```

---

## 📞 Help

**Kompletna dokumentacija:**  
`C:\laragon\www\laravel-postgresql-demo\POSTGRESQL-SETUP.md`

**HeidiSQL** (GUI za PostgreSQL):  
`C:\laragon\bin\heidisql\heidisql.exe`

**pgAdmin 4 Download:**  
https://www.pgadmin.org/download/

---

## 🎨 Tabler UI Komponente - Quick Reference

### Master Layout

```blade
<x-layouts.app title="Naslov Stranice">
    <x-navbar />
    <x-sidebar />
    
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <!-- Sadržaj -->
            </div>
        </div>
    </div>
</x-layouts.app>
```

### Card

```blade
<x-ui.card>
    <x-slot name="header">Naslov</x-slot>
    Sadržaj
    <x-slot name="footer">Footer</x-slot>
</x-ui.card>
```

### Alert

```blade
<!-- Tipovi: info, success, warning, danger -->
<x-ui.alert type="success" :dismissible="true">
    Poruka
</x-ui.alert>
```

### Button

```blade
<!-- Varijante: primary, secondary, success, warning, danger, info -->
<x-ui.button variant="primary" icon="ti ti-plus">
    Tekst
</x-ui.button>

<!-- Outline -->
<x-ui.button variant="danger" :outline="true">Obriši</x-ui.button>
```

### Form Input

```blade
<x-ui.form-input
    name="email"
    type="email"
    label="Email"
    placeholder="email@primjer.com"
    icon="ti ti-mail"
    :required="true"
/>
```

### Table

```blade
<x-ui.table :headers="['ID', 'Ime', 'Email']">
    <tr>
        <td>1</td>
        <td>Ivan</td>
        <td>ivan@test.com</td>
    </tr>
</x-ui.table>
```

### Modal

```blade
<button data-bs-toggle="modal" data-bs-target="#myModal">
    Otvori
</button>

<x-ui.modal id="myModal" title="Naslov">
    Sadržaj modala
    <x-slot name="footer">
        <x-ui.button variant="primary">Spremi</x-ui.button>
    </x-slot>
</x-ui.modal>
```

### Tabler Icons

```html
<i class="ti ti-user"></i>
<i class="ti ti-mail"></i>
<i class="ti ti-phone"></i>
<i class="ti ti-home"></i>
<i class="ti ti-settings"></i>
```

**Sve ikone:** https://tabler-icons.io/

---

**Last Updated:** 28. Februar 2026
