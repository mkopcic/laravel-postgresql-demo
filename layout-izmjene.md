# Layout izmjene

## 2026-05-18

### welcome.blade.php — ispravka verzije

- Zamijenjeno svih 5 pojavljivanja `Laravel 12` → `Laravel 13` (hero badge, opis stack kartice, footer link, footer badge)

### admin/users/index.blade.php — uloga badge vidljivost

**Problem:** `bg-red` / `bg-blue` Tabler klase bez `text-*` nisu davale dobar kontrast, posebno u dark modeu. `bg-secondary` za "Bez uloge" bio je gotovo nevidljiv.

**Rješenje:** Zamjena na Bootstrap 5 `text-bg-*` klase koje automatski postavljaju i pozadinu i boju teksta s ispravnim kontrastom u oba modea:

| Uloga     | Prije       | Poslije            |
|-----------|-------------|---------------------|
| Admin     | `bg-red`    | `text-bg-danger`   |
| User      | `bg-blue`   | `text-bg-primary`  |
| Bez uloge | `bg-secondary` | `text-bg-warning` |
