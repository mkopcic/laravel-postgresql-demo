# Laravel 12 → 13 Upgrade

Upgrade s **Laravel 12.57.0** na **Laravel 13.9.0**. Izvedeno 2026-05-18.

## Sažetak

Izmijenjeni su samo `composer.json` i `composer.lock`. **Nula promjena u app kodu** — projekt
ne koristi nijedan uklonjeni ili preimenovani API iz Laravel 13 / spatie v7 / spatie v10.

## Promjene constraint-a (`composer.json`)

| Paket | Prije | Poslije | Razlog |
|---|---|---|---|
| `php` | `^8.2` | `^8.3` | Laravel 13 + phpunit 12 + permission 7 minimum |
| `laravel/framework` | `^12.0` | `^13.0` | major upgrade |
| `laravel/tinker` | `^2.10.1` | `^3.0` | v2 zaključan na illuminate `^12` |
| `opcodesio/log-viewer` | `^3.23` | `^3.24` | prva verzija s L13 podrškom |
| `spatie/laravel-backup` | `^9.1` | `^10.0` | v9 zaključan na illuminate `^12.40` |
| `spatie/laravel-medialibrary` | `^11.21` | `^11.22` | L13 podrška |
| `spatie/laravel-permission` | `^6.11` | `^7.0` | v6 zaključan na `^12` |
| `nunomaduro/collision` | `^8.6` | `^8.9` | v8.9.x miče konflikt s framework `>=13` |
| `phpunit/phpunit` | `^11.5.3` | `^12.0` | L13 zadani test stack |

Paketi bez promjene constraint-a (već podržavaju L13, samo `composer update`):
`predis/predis`, `spatie/laravel-activitylog`, `barryvdh/laravel-debugbar`,
`laravel/boost`, `laravel/sail`, `laravel/pail`, `laravel/pint`.

## Instalirane verzije nakon upgradea

```
laravel/framework            13.9.0
laravel/tinker               3.0.2
spatie/laravel-permission    7.4.1
spatie/laravel-backup        10.2.1
spatie/laravel-medialibrary  11.22.1
spatie/laravel-activitylog   4.12.3
opcodesio/log-viewer         3.24.0
nunomaduro/collision         8.9.4
barryvdh/laravel-debugbar    4.2.8
phpunit/phpunit              12.5.25
```

## Verifikacija

- `composer update` exit 0, nema security advisory-ja
- `php artisan about` → Laravel 13.9.0 / PHP 8.5.0, app se buta čisto
- Rute i migracije rade
- Test suite: 2/2 prošlo
- `php artisan permission:cache-reset` radi (spatie permission v7 funkcionalan)

## Zašto nije trebao kod-fix

Provjereni i nepronađeni u app kodu:

- Laravel 13: CSRF middleware rename (`VerifyCsrfToken`/`ValidateCsrfToken` →
  `PreventRequestForgery`), `HasUuids`, `JobAttempted::$exceptionOccurred`,
  `upsert()` `uniqueBy` validacija, `QueueBusy::$connection`, custom `Manager::extend`,
  `Js::from`, pagination view nazivi
- spatie/laravel-permission v7: stari event/command nazivi, `clearClassPermissions()`
- spatie/laravel-backup v10: `consoleOutput()`, `ConsoleOutput`,
  `BackupJob::disableNotifications()`, `getHealthCheckFailure()`

`config/permission.php` već koristi nove `*Event` nazive; `config/backup.php` već ima
v10 opcije (`continue_on_failure`, `verify_backup`, `encryption => 'default'`).

## Napomene za produkciju

- Laravel 13 mijenja format cache prefiksa i session cookie naziva (`_` → `-`). Na prvom
  deployu korisnici se jednom odjave. Session/cache su na `database` driveru pa je utjecaj
  minimalan. Opcionalno fiksirati `SESSION_COOKIE` / `CACHE_PREFIX` u `.env`.
- Cache `serializable_classes` u Laravel 13 defaultira na `false` (sigurnosno otvrdnjavanje).
  Ako se PHP objekti spremaju u cache, eksplicitno ih allow-listati.
- Pint prijavljuje pre-postojeće stilske greške nepovezane s upgradeom — nisu dirane.
