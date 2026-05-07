# 🐘 PostgreSQL + Laravel - Kompletna Instalacija i Konfiguracija

**Datum instalacije:** 28. februar 2026.  
**PostgreSQL verzija:** 16.6 (Windows x64)  
**Laravel verzija:** 12.53.0  
**PHP verzija:** 8.3.30 (preporučena - stabilan)

⚠️ **VAŽNO:** PHP 8.5.x je beta/preview verzija i Carbon paket ima probleme sa kompatibilnošću. Koristi PHP 8.3.x za production!

---

## 📋 Sadržaj

1. [PostgreSQL Instalacija](#postgresql-instalacija)
2. [Login Podaci](#login-podaci)
3. [Upravljanje PostgreSQL Serverom](#upravljanje-postgresql-serverom)
4. [Laravel Konfiguracija](#laravel-konfiguracija)
5. [Apache VirtualHost](#apache-virtualhost)
6. [PostgreSQL Ekstenzije](#postgresql-ekstenzije)
7. [Laragon Integracija](#laragon-integracija)
8. [Korisne Komande](#korisne-komande)

---

## 🔧 PostgreSQL Instalacija

### Lokacije Fajlova

| Komponenta                  | Putanja                                                   |
| --------------------------- | --------------------------------------------------------- |
| **PostgreSQL Binaries**     | `C:\laragon\bin\postgresql\pgsql\bin\`                    |
| **Data Direktorij**         | `C:\laragon\data\postgresql\`                             |
| **Konfiguracijski Fajlovi** | `C:\laragon\data\postgresql\`                             |
| **Server Log**              | `C:\laragon\data\postgresql\server.log`                   |
| **php.ini**                 | `C:\laragon\bin\php\php-8.5.0-nts-Win32-vs17-x64\php.ini` |

### Instalirana Baza Podataka

```
Naziv baze: postgresql_test
Vlasnik:    postgres
Encoding:   UTF8
Collation:  C
Status:     Aktivna ✓
```

---

## 🔐 Login Podaci (ROOT)

### PostgreSQL Superuser

```yaml
Host: localhost (127.0.0.1)
Port: 5432
Username: postgres
Password: (prazno - nema passworda)
Auth: trust
Database: postgres (default) ili postgresql_test
```

### Connection String

```bash
# Format
postgresql://postgres@localhost:5432/postgresql_test

# psql komanda
psql -U postgres -h localhost -p 5432 -d postgresql_test

# URL format (za aplikacije)
postgres://postgres@localhost:5432/postgresql_test
```

### ⚠️ Napomena o Sigurnosti

**Trenutna konfiguracija:** Trust authentication (bez lozinke)  
**Preporučeno za:** Development  
**NIJE preporučeno za:** Production

#### Kako dodati lozinku za postgres korisnika:

```sql
-- 1. Poveži se na bazu
psql -U postgres

-- 2. Postavi lozinku
ALTER USER postgres WITH PASSWORD 'tvoja_jaka_lozinka';

-- 3. Uredi pg_hba.conf
-- Promijeni: trust → md5
```

**Fajl:** `C:\laragon\data\postgresql\pg_hba.conf`

```ini
# IPv4 local connections:
host    all             all             127.0.0.1/32            md5
# IPv6 local connections:
host    all             all             ::1/128                 md5
```

Nakon izmjene, restartuj server:

```bash
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" restart
```

---

## ⚙️ Upravljanje PostgreSQL Serverom

### Metoda 1: Batch Skripte (Najlakše)

Laragon direktorij: `C:\laragon\bin\postgresql\`

| Skripta                  | Funkcija            |
| ------------------------ | ------------------- |
| `start-postgresql.bat`   | Pokreni server      |
| `stop-postgresql.bat`    | Zaustavi server     |
| `restart-postgresql.bat` | Restartuj server    |
| `status-postgresql.bat`  | Provjeri status     |
| `psql-connect.bat`       | Otvori psql klijent |

**Upotreba:** Dvostruki klik na .bat fajl

---

### Metoda 2: PowerShell Komande

```powershell
# Start PostgreSQL servera
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" -l "C:\laragon\data\postgresql\server.log" start

# Stop PostgreSQL servera
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" stop

# Restart PostgreSQL servera
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" restart

# Status servera
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" status

# Reload konfiguracije (bez restarta)
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" reload
```

---

### Metoda 3: Kroz Laragon UI

Laragon **NEMA** native PostgreSQL integraciju kao MySQL, ali možeš:

1. **Dodati Quick Action:**
    - Desni klik na Laragon tray icon
    - `Tools` → `Quick app...`
    - Dodaj start/stop skripte

2. **Auto-start na Windows Boot (opciono):**
    - Task Scheduler → Create Basic Task
    - Trigger: At system startup
    - Action: `C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe`
    - Arguments: `-D C:\laragon\data\postgresql -l C:\laragon\data\postgresql\server.log start`

---

## 🚀 Laravel Konfiguracija

### .env file

**Lokacija:** `C:\laragon\www\laravel-postgresql-demo\.env`

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=15432
DB_DATABASE=postgresql_test
DB_USERNAME=postgres
DB_PASSWORD=
```

> ⚠️ Zbog Windows rezervacije portova (WSL/Hyper-V), port `5432` i `5433` su blokirani. PostgreSQL sada koristi `15432`.
>
> Promjena je izvršena u:
>
> - `C:\laragon\data\postgresql\postgresql.conf`
> - `C:\laragon\www\laravel-postgresql-demo\.env`

### Testiranje PostgreSQL konekcije

Pokreni ove komande da provjeriš da li server radi na `15432`:

```powershell
# Provjeri da PostgreSQL sluša na novom portu
netstat -aon | findstr 15432

# Provjeri status servera
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" status

# Testiraj konekciju iz psql klijenta
& "C:\laragon\bin\postgresql\pgsql\bin\psql.exe" -U postgres -h localhost -p 15432 -d postgresql_test -c "SELECT version();"
```

### database.php (Automatski podešeno)

Laravel automatski koristi PostgreSQL driver kada je `DB_CONNECTION=pgsql`.

### PHP Ekstenzije (Već omogućene)

**Lokacija:** `C:\laragon\bin\php\php-8.5.0-nts-Win32-vs17-x64\php.ini`

```ini
extension=pdo_pgsql
extension=pgsql
```

**Provjeri da li su aktivne:**

```bash
php -m | Select-String "pdo_pgsql|pgsql"
```

### Migracije Izvršene ✓

```bash
php artisan migrate:fresh
```

**Tabele u bazi `postgresql_test`:**

- cache
- cache_locks
- failed_jobs
- job_batches
- jobs
- migrations
- password_reset_tokens
- sessions
- users

---

## 🌐 Apache VirtualHost

### Automatski Generisan VirtualHost

**Lokacija:** `C:\laragon\etc\apache2\sites-enabled\auto.laravel-postgresql-demo.test.conf`

```apache
define ROOT "C:/laragon/www/laravel-postgresql-demo/public"
define SITE "laravel-postgresql-demo.test"

<VirtualHost *:80>
    DocumentRoot "${ROOT}"
    ServerName ${SITE}
    ServerAlias *.${SITE}
    <Directory "${ROOT}">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:443>
    DocumentRoot "${ROOT}"
    ServerName ${SITE}
    ServerAlias *.${SITE}
    <Directory "${ROOT}">
        AllowOverride All
        Require all granted
    </Directory>

    SSLEngine on
    SSLCertificateFile      C:/laragon/etc/ssl/laragon.crt
    SSLCertificateKeyFile   C:/laragon/etc/ssl/laragon.key
</VirtualHost>
```

### Pristup Sajtu

```
HTTP:  http://laravel-postgresql-demo.test
HTTPS: https://laravel-postgresql-demo.test
```

### Ažuriranje VirtualHost-a

Ako menjaš bilo šta u konfiguraciji:

```powershell
# Restart Apache kroz Laragon
# Ili PowerShell:
Restart-Service -Name "Apache*" -Force
```

---

## 🔌 PostgreSQL Ekstenzije

### Gdje Dodati/Upravljati Ekstenzijama?

#### 1. Pregled Instaliranih Ekstenzija

```sql
-- Poveži se na bazu
psql -U postgres -d postgresql_test

-- Prikaži sve dostupne ekstenzije
SELECT * FROM pg_available_extensions ORDER BY name;

-- Prikaži instalirane ekstenzije
\dx
```

#### 2. Instalacija Popularnih Ekstenzija

```sql
-- UUID support
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- PostGIS (geospatial)
CREATE EXTENSION IF NOT EXISTS postgis;

-- Full-text search (unaccent)
CREATE EXTENSION IF NOT EXISTS unaccent;

-- Fuzzy string matching
CREATE EXTENSION IF NOT EXISTS fuzzystrmatch;

-- Cryptographic functions
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- Foreign data wrappers
CREATE EXTENSION IF NOT EXISTS postgres_fdw;
```

#### 3. Dostupne Ekstenzije u PostgreSQL 16.6

**Glavne ekstenzije koje dolaze sa instalacijom:**

| Ekstenzija           | Opis                        |
| -------------------- | --------------------------- |
| `pg_stat_statements` | Track execution statistics  |
| `pgcrypto`           | Cryptographic functions     |
| `uuid-ossp`          | UUID generator              |
| `hstore`             | Key-value store             |
| `citext`             | Case-insensitive text       |
| `ltree`              | Hierarchical tree structure |
| `pg_trgm`            | Trigram matching            |
| `tablefunc`          | Cross-tabulation functions  |

#### 4. Dodatne Ekstenzije (Ručna Instalacija)

Za složenije ekstenzije kao **PostGIS**, potrebna je dodatna instalacija:

```powershell
# Preuzmi PostGIS instalaciju za PostgreSQL 16
# https://postgis.net/windows_downloads/
```

#### 5. Provjera Da Li Je Ekstenzija Instalirana

```sql
SELECT * FROM pg_extension WHERE extname = 'uuid-ossp';
```

#### 6. Uklanjanje Ekstenzije

```sql
DROP EXTENSION IF EXISTS uuid-ossp;
```

### Konfiguracijske Datoteke za Ekstenzije

**postgresql.conf** - `C:\laragon\data\postgresql\postgresql.conf`

```ini
# Omogući dodatne ekstenzije
shared_preload_libraries = 'pg_stat_statements'

# Performance tuning
max_connections = 100
shared_buffers = 128MB
effective_cache_size = 512MB
```

**Napomena:** Nakon izmjene `shared_preload_libraries`, mora restart servera!

---

## 💻 Laragon Integracija

### Trenutno Stanje

| Servis     | Status              | Način Upravljanja            |
| ---------- | ------------------- | ---------------------------- |
| MySQL      | ✓ Native u Laragonu | Laragon UI (Start/Stop)      |
| PostgreSQL | ✓ Ručno instaliran  | Batch skripte ili PowerShell |
| Apache     | ✓ Native u Laragonu | Laragon UI                   |
| nginx      | ✓ Native u Laragonu | Laragon UI                   |
| PHP        | ✓ Native u Laragonu | Laragon UI (version switch)  |

### Gdje Upravlja Laragon?

#### 1. **Laragon UI (Tray Icon)**

- Start/Stop MySQL, Apache, nginx
- Switchanje PHP verzija
- Kreiranje Quick Actions
- Terminala

#### 2. **Automatski VirtualHost-ovi**

- Laragon automatski detektuje nove projekte u `C:\laragon\www\`
- Auto-generacija `.test` domena
- Apache/nginx konfiguracijske datoteke

#### 3. **PHP Extensions**

- Laragon → Menu → PHP → php.ini
- Ili direktno: `C:\laragon\bin\php\{verzija}\php.ini`

#### 4. **Database Management Tools**

**HeidiSQL** (Dolazi sa Laragonom):

- `C:\laragon\bin\heidisql\heidisql.exe`
- Podržava MySQL i PostgreSQL!

**Kako dodati PostgreSQL konekciju u HeidiSQL:**

1. Otvori HeidiSQL
2. New → Session name: `PostgreSQL Laragon`
3. **Network type:** PostgreSQL
4. **Hostname:** 127.0.0.1
5. **User:** postgres
6. **Port:** 5432
7. **Password:** (ostavi prazno)
8. Save & Connect

#### 5. **Gdje PostgreSQL NIJE Integrisan**

Laragon nema:

- ❌ UI dugme za start/stop PostgreSQL
- ❌ Automatsku instalaciju PostgreSQL
- ❌ Service management za PostgreSQL

**Rješenje:** Koristi batch skripte koje smo kreirali!

---

## 📚 Korisne Komande

### PostgreSQL Administracija

```powershell
# Kreiranje nove baze
& "C:\laragon\bin\postgresql\pgsql\bin\createdb.exe" -U postgres ime_baze

# Brisanje baze
& "C:\laragon\bin\postgresql\pgsql\bin\dropdb.exe" -U postgres ime_baze

# Kreiranje novog USER-a
& "C:\laragon\bin\postgresql\pgsql\bin\psql.exe" -U postgres -c "CREATE USER moj_user WITH PASSWORD 'lozinka';"

# GRANT privilegije
& "C:\laragon\bin\postgresql\pgsql\bin\psql.exe" -U postgres -c "GRANT ALL PRIVILEGES ON DATABASE postgresql_test TO moj_user;"

# Lista svih baza
& "C:\laragon\bin\postgresql\pgsql\bin\psql.exe" -U postgres -c "\l"

# Backup baze
& "C:\laragon\bin\postgresql\pgsql\bin\pg_dump.exe" -U postgres -d postgresql_test -f "C:\backup\postgresql_test_backup.sql"

# Restore baze
& "C:\laragon\bin\postgresql\pgsql\bin\psql.exe" -U postgres -d postgresql_test -f "C:\backup\postgresql_test_backup.sql"
```

### psql Interaktivne Komande

```sql
-- Poveži se na bazu
psql -U postgres -d postgresql_test

-- Osnovne komande
\l              -- Lista svih baza
\c ime_baze     -- Switch na drugu bazu
\dt             -- Lista tabela
\d+ table_name  -- Detalji tabele
\du             -- Lista korisnika
\dx             -- Lista ekstenzija
\dn             -- Lista schema
\df             -- Lista funkcija
\dv             -- Lista view-ova
\q              -- Izlaz iz psql
\?              -- Pomoć
\h CREATE TABLE -- Help za određenu SQL komandu

-- Performance
\timing         -- Prikaži vrijeme izvršavanja
```

### Laravel + PostgreSQL

```bash
# Fresh migracije
php artisan migrate:fresh

# Seed baze
php artisan db:seed

# Rollback
php artisan migrate:rollback

# Status migracija
php artisan migrate:status

# Kreiranje nove migracije
php artisan make:migration create_example_table

# Tinker (Laravel interaktivna konzola)
php artisan tinker

# U Tinkeru:
DB::connection()->getPdo();  // Test konekcije
DB::select('SELECT version()');  // PostgreSQL verzija
```

### Diagnostic Komande

```powershell
# Provjeri port 5432
Test-NetConnection -ComputerName localhost -Port 5432

# Provjeri PostgreSQL procese
Get-Process | Where-Object {$_.ProcessName -like "*postgres*"}

# Provjeri PHP ekstenzije
php -m | Select-String "pdo_pgsql|pgsql"

# Provjeri PHP verziju
php -v

# Provjeri Composer
composer --version

# PostgreSQL verzija
& "C:\laragon\bin\postgresql\pgsql\bin\postgres.exe" --version

# Server status detalji
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" status

# Provjeri log
Get-Content "C:\laragon\data\postgresql\server.log" -Tail 50
```

---

## 🛠️ Troubleshooting

### Problem: "could not find driver"

**Rješenje:**

```powershell
# 1. Otvori php.ini
notepad "C:\laragon\bin\php\php-8.5.0-nts-Win32-vs17-x64\php.ini"

# 2. Omogući ekstenzije (već urađeno):
extension=pdo_pgsql
extension=pgsql

# 3. Restart Apache
# Putem Laragon UI: Stop All → Start All
```

### Problem: Port 5432 zauzet

```powershell
# Provjeri koji proces koristi port 5432
Get-NetTCPConnection -LocalPort 5432 |
    Select-Object -Property LocalPort, OwningProcess, State

# Stop PostgreSQL
& "C:\laragon\bin\postgresql\pgsql\bin\pg_ctl.exe" -D "C:\laragon\data\postgresql" stop

# Ili promijeni port u postgresql.conf
# port = 5433
```

### Problem: Permission Denied

```powershell
# Pokreni PowerShell ili Command Prompt kao Administrator
# Ili provjeri permisije na:
icacls "C:\laragon\data\postgresql"
```

### Problem: Server Won't Start

```powershell
# Provjeri log
Get-Content "C:\laragon\data\postgresql\server.log" -Tail 100

# Provjeri da li je data direktorij inicijalizovan
Test-Path "C:\laragon\data\postgresql\PG_VERSION"

# Ako treba re-init (PAZI: briše sve podatke!)
Remove-Item "C:\laragon\data\postgresql\*" -Recurse -Force
& "C:\laragon\bin\postgresql\pgsql\bin\initdb.exe" -D "C:\laragon\data\postgresql" -U postgres -E UTF8 --locale=C --auth=trust
```

---

## 🔗 Korisni Linkovi

- [PostgreSQL 16 Dokumentacija](https://www.postgresql.org/docs/16/)
- [Laravel Database Documentation](https://laravel.com/docs/12.x/database)
- [Laravel PostgreSQL Tips](https://laravel.com/docs/12.x/database#postgresql)
- [pgAdmin 4 Download](https://www.pgadmin.org/download/)
- [HeidiSQL](https://www.heidisql.com/)
- [PostGIS](https://postgis.net/)

---

## 📊 Summary

### ✅ Što je instalirano:

- [x] PostgreSQL 16.6 (portable u Laragon strukturi)
- [x] PHP pdo_pgsql & pgsql ekstenzije
- [x] Laravel 12.53.0 sa PostgreSQL driverom
- [x] Baza podataka `postgresql_test`
- [x] Apache VirtualHost konfiguracija
- [x] Batch skripte za upravljanje

### 🔐 Pristupni Podaci (ROOT):

```
Host:     127.0.0.1
Port:     5432
User:     postgres
Password: (prazno)
Database: postgresql_test
```

### 🚀 Quick Start:

```bash
# 1. Startuj PostgreSQL
C:\laragon\bin\postgresql\start-postgresql.bat

# 2. Startuj Apache (Laragon UI)

# 3. Otvori sajt
http://laravel-postgresql-demo.test

# 4. Poveži se na bazu
C:\laragon\bin\postgresql\psql-connect.bat
```

---

## 🛠️ Critical Troubleshooting

### ❌ Problem: Carbon\CarbonPeriod::getIterator() Error (PHP 8.5+)

**Greška:**

```
Declaration of Carbon\CarbonPeriod::getIterator(): Generator must be compatible with DatePeriod::getIterator(): Iterator
```

**Uzrok:** PHP 8.5.x je beta/preview verzija i nije kompatibilna sa Carbon paketom koji Laravel koristi.

**Rješenje: PROMIJENI PHP VERZIJU na 8.3.30**

#### Korak 1: Prebaci PHP u Laragonu

**Preko Laragon UI:**

1. Desni klik na Laragon tray icon
2. **PHP** → **Version** → **php-8.3.30**
3. Laragon će automatski restartovati Apache

ILI kroz Command Line:

```powershell
# Stop Apache
# Promijeni PHP verziju kroz Laragon UI
# Start Apache
```

#### Korak 2: Reinstaliraj Composer Dependencies

```powershell
cd C:\laragon\www\laravel-postgresql-demo

# Obriši vendor i cache
Remove-Item -Recurse -Force vendor, bootstrap/cache/*.php

# Obriši composer.lock (JER je lockovan za PHP 8.4+)
Remove-Item composer.lock -Force

# Reinstaliraj sa PHP 8.3.30
composer update --optimize-autoloader
```

#### Korak 3: Testiranje

```powershell
# Provjeri PHP verziju
php -v  # Trebalo bi: PHP 8.3.30

# Provjer ekstenzije
php -m | Select-String "pdo_pgsql|pgsql"

# Testiranje Laravel-a
php artisan migrate:status
```

#### Korak 4: Otvori Browser

```
http://laravel-postgresql-demo.test
```

Trebalo bi raditi bez greške! ✅

---

**Autor:** GitHub Copilot  
**Datum:** 28. Februar 2026  
**Laragon verzija:** Latest  
**OS:** Windows 11
