# 🎨 Tabler UI Komponente - Kompletan Vodič

Detaljni vodič za sve Blade komponente u projektu.

---

## 📦 Dostupne Komponente

| Komponenta | Lokacija | Namjena |
|------------|----------|---------|
| **Layout** | `layouts/app.blade.php` | Master layout |
| **Navbar** | `navbar.blade.php` | Top navigation |
| **Sidebar** | `sidebar.blade.php` | Glavni meni |
| **Card** | `ui/card.blade.php` | Content wrapper |
| **Alert** | `ui/alert.blade.php` | Obavijesti |
| **Button** | `ui/button.blade.php` | Dugmad |
| **Form Input** | `ui/form-input.blade.php` | Input polja |
| **Modal** | `ui/modal.blade.php` | Dialozi |
| **Table** | `ui/table.blade.php` | Tablice |

---

## 🎯 1. Master Layout

### Osnovni Primjer

```blade
<x-layouts.app title="Dashboard">
    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <h1>Moja Stranica</h1>
            </div>
        </div>
    </div>
</x-layouts.app>
```

### S Dodatnim Head Sadržajem

```blade
<x-layouts.app title="Grafički Prikaz">
    <x-slot name="head">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            .custom-style { color: red; }
        </style>
    </x-slot>

    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
        <!-- Sadržaj -->
    </div>

    <x-slot name="scripts">
        <script>
            // Custom JS
            console.log('Page loaded');
        </script>
    </x-slot>
</x-layouts.app>
```

### Page Header Pattern

```blade
<div class="page-wrapper">
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Naslov Stranice</h2>
                    <div class="text-secondary mt-1">
                        Opis stranice
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <x-ui.button variant="primary" icon="ti ti-plus">
                            Nova Akcija
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Sadržaj -->
        </div>
    </div>
</div>
```

---

## 🃏 2. Card Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `header` | slot | Ne | - | Header sadržaj |
| `footer` | slot | Ne | - | Footer sadržaj |
| `class` | string | Ne | `card` | Dodatne CSS klase |

### Primjeri

```blade
<!-- Jednostavni Card -->
<x-ui.card>
    <p>Jednostavan sadržaj.</p>
</x-ui.card>

<!-- Card S Headerom -->
<x-ui.card>
    <x-slot name="header">
        <h3 class="card-title">Naslov Kartice</h3>
    </x-slot>
    
    <p>Glavni sadržaj kartice.</p>
</x-ui.card>

<!-- Card S Headerom i Footerom -->
<x-ui.card>
    <x-slot name="header">
        <h3 class="card-title">Korisničke Informacije</h3>
    </x-slot>
    
    <div class="mb-3">
        <strong>Ime:</strong> Ivan Horvat
    </div>
    <div class="mb-3">
        <strong>Email:</strong> ivan@example.com
    </div>
    
    <x-slot name="footer">
        <div class="d-flex justify-content-end">
            <x-ui.button variant="primary">Spremi</x-ui.button>
        </div>
    </x-slot>
</x-ui.card>

<!-- Card S Custom Klasom -->
<x-ui.card class="card-sm bg-light">
    Mala kartica s custom bojom.
</x-ui.card>

<!-- Stats Card -->
<x-ui.card class="card-sm">
    <div class="d-flex align-items-center">
        <span class="bg-primary text-white avatar">
            <i class="ti ti-users"></i>
        </span>
        <div class="ms-3">
            <div class="text-secondary">Total Users</div>
            <div class="h1 mb-0">2,543</div>
        </div>
    </div>
</x-ui.card>
```

---

## 🚨 3. Alert Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `type` | string | Ne | `info` | Tip alerta (info, success, warning, danger) |
| `dismissible` | boolean | Ne | `false` | Može li se zatvoriti |
| `icon` | string | Ne | Auto | Custom ikona |
| `class` | string | Ne | - | Dodatne CSS klase |

### Primjeri

```blade
<!-- Info Alert -->
<x-ui.alert type="info">
    Ovo je informativna poruka.
</x-ui.alert>

<!-- Success Alert -->
<x-ui.alert type="success">
    <strong>Uspjeh!</strong> Podatci su uspješno spremljeni.
</x-ui.alert>

<!-- Warning Alert -->
<x-ui.alert type="warning">
    <strong>Upozorenje!</strong> Provjerite unos prije nastavka.
</x-ui.alert>

<!-- Danger Alert -->
<x-ui.alert type="danger">
    <strong>Greška!</strong> Nešto je pošlo po zlu.
</x-ui.alert>

<!-- Dismissible Alert -->
<x-ui.alert type="success" :dismissible="true">
    Alert koji može biti zatvoren.
</x-ui.alert>

<!-- Custom Icon -->
<x-ui.alert type="info" icon="ti ti-star">
    Alert s custom ikonom.
</x-ui.alert>

<!-- Bez Ikone -->
<x-ui.alert type="info" icon="">
    Alert bez ikone.
</x-ui.alert>

<!-- S Listom -->
<x-ui.alert type="warning">
    <strong>Sljedeća polja su obavezna:</strong>
    <ul class="mt-2 mb-0">
        <li>Ime i prezime</li>
        <li>Email adresa</li>
        <li>Telefon</li>
    </ul>
</x-ui.alert>
```

---

## 🔘 4. Button Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `variant` | string | Ne | `primary` | Boja buttona |
| `size` | string | Ne | - | Veličina (sm, lg) |
| `icon` | string | Ne | - | Tabler ikona |
| `outline` | boolean | Ne | `false` | Outline stil |
| `type` | string | Ne | `button` | HTML tip (button, submit, reset) |

### Varijante

- `primary` - Plava
- `secondary` - Siva
- `success` - Zelena
- `warning` - Narančasta
- `danger` - Crvena
- `info` - Svijetlo plava
- `light` - Svijetla
- `dark` - Tamna

### Primjeri

```blade
<!-- Osnovni Button -->
<x-ui.button variant="primary">
    Klikni me
</x-ui.button>

<!-- Button S Ikonom -->
<x-ui.button variant="success" icon="ti ti-plus">
    Dodaj novi
</x-ui.button>

<!-- Outline Button -->
<x-ui.button variant="danger" :outline="true">
    Obriši
</x-ui.button>

<!-- Submit Button -->
<x-ui.button variant="primary" type="submit">
    Pošalji Formu
</x-ui.button>

<!-- Veliki Button -->
<x-ui.button variant="primary" size="lg">
    Veliki Button
</x-ui.button>

<!-- Mali Button -->
<x-ui.button variant="secondary" size="sm">
    Mali Button
</x-ui.button>

<!-- Button S Dodatnim Atributima -->
<x-ui.button 
    variant="primary" 
    icon="ti ti-download"
    data-bs-toggle="modal" 
    data-bs-target="#downloadModal"
>
    Preuzmi
</x-ui.button>

<!-- Disabled Button -->
<x-ui.button variant="primary" disabled>
    Disabled
</x-ui.button>

<!-- Button Grupa -->
<div class="btn-list">
    <x-ui.button variant="primary">Akcija 1</x-ui.button>
    <x-ui.button variant="secondary">Akcija 2</x-ui.button>
    <x-ui.button variant="success">Akcija 3</x-ui.button>
</div>

<!-- Full Width Button -->
<x-ui.button variant="primary" class="w-100">
    Cijela širina
</x-ui.button>
```

---

## 📝 5. Form Input Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `name` | string | Da | - | Input name attribute |
| `label` | string | Ne | - | Label text |
| `type` | string | Ne | `text` | Input tip |
| `placeholder` | string | Ne | - | Placeholder text |
| `required` | boolean | Ne | `false` | Je li obavezno |
| `hint` | string | Ne | - | Help tekst |
| `error` | string | Ne | - | Error poruka |
| `icon` | string | Ne | - | Tabler ikona |

### Primjeri

```blade
<!-- Osnovni Input -->
<x-ui.form-input
    name="username"
    label="Korisničko ime"
    placeholder="Unesite korisničko ime"
/>

<!-- Email Input S Ikonom -->
<x-ui.form-input
    name="email"
    type="email"
    label="Email adresa"
    placeholder="email@primjer.com"
    icon="ti ti-mail"
    :required="true"
/>

<!-- Input S Hint Tekstom -->
<x-ui.form-input
    name="phone"
    type="tel"
    label="Telefon"
    placeholder="+385 99 123 4567"
    icon="ti ti-phone"
    hint="Format: +385 99 123 4567"
/>

<!-- Input S Error Porukom -->
<x-ui.form-input
    name="password"
    type="password"
    label="Lozinka"
    error="{{ $errors->first('password') }}"
/>

<!-- Obavezan Input -->
<x-ui.form-input
    name="full_name"
    label="Ime i prezime"
    icon="ti ti-user"
    :required="true"
/>

<!-- Number Input -->
<x-ui.form-input
    name="age"
    type="number"
    label="Dob"
    placeholder="25"
    hint="Morate imati više od 18 godina"
/>

<!-- Date Input -->
<x-ui.form-input
    name="birth_date"
    type="date"
    label="Datum rođenja"
    icon="ti ti-calendar"
/>

<!-- URL Input -->
<x-ui.form-input
    name="website"
    type="url"
    label="Website"
    placeholder="https://example.com"
    icon="ti ti-world"
/>

<!-- Form Primjer -->
<form method="POST" action="/users">
    @csrf
    
    <x-ui.form-input
        name="name"
        label="Ime i prezime"
        placeholder="Ivan Horvat"
        icon="ti ti-user"
        :required="true"
    />
    
    <x-ui.form-input
        name="email"
        type="email"
        label="Email"
        placeholder="ivan@example.com"
        icon="ti ti-mail"
        :required="true"
    />
    
    <x-ui.form-input
        name="phone"
        type="tel"
        label="Telefon"
        placeholder="+385 99 123 4567"
        icon="ti ti-phone"
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
```

---

## 📊 6. Table Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `headers` | array | Ne | `[]` | Header kolone |
| `striped` | boolean | Ne | `false` | Striped redovi |
| `hoverable` | boolean | Ne | `true` | Hover efekt |
| `responsive` | boolean | Ne | `true` | Responsive wrapper |

### Primjeri

```blade
<!-- Osnovna Tablica -->
<x-ui.table :headers="['ID', 'Ime', 'Email']">
    <tr>
        <td>1</td>
        <td>Ivan Horvat</td>
        <td>ivan@example.com</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Ana Kovač</td>
        <td>ana@example.com</td>
    </tr>
</x-ui.table>

<!-- Striped Tablica -->
<x-ui.table :headers="['Datum', 'Opis', 'Iznos']" :striped="true">
    <tr>
        <td>2026-02-28</td>
        <td>Plaćanje</td>
        <td>€100.00</td>
    </tr>
    <tr>
        <td>2026-02-27</td>
        <td>Uplata</td>
        <td>€250.00</td>
    </tr>
</x-ui.table>

<!-- Tablica S Akcijama -->
<x-ui.table :headers="['ID', 'Ime', 'Status', 'Akcije']">
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>
            <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                {{ $user->is_active ? 'Aktivan' : 'Neaktivan' }}
            </span>
        </td>
        <td>
            <div class="btn-list">
                <x-ui.button variant="primary" size="sm" icon="ti ti-edit">
                    Uredi
                </x-ui.button>
                <x-ui.button variant="danger" size="sm" icon="ti ti-trash" :outline="true">
                    Obriši
                </x-ui.button>
            </div>
        </td>
    </tr>
    @endforeach
</x-ui.table>

<!-- Tablica S Avatar-om -->
<x-ui.table :headers="['Korisnik', 'Email', 'Uloga']">
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <span class="avatar me-2">IH</span>
                <div>
                    <div>Ivan Horvat</div>
                    <div class="text-secondary">Administrator</div>
                </div>
            </div>
        </td>
        <td>ivan@example.com</td>
        <td><span class="badge bg-red">Admin</span></td>
    </tr>
</x-ui.table>

<!-- Tablica U Card-u -->
<x-ui.card>
    <x-slot name="header">
        <h3 class="card-title">Najnoviji Korisnici</h3>
    </x-slot>
    
    <x-ui.table :headers="['Ime', 'Email', 'Registracija']">
        <tr>
            <td>Ivan Horvat</td>
            <td>ivan@test.com</td>
            <td>28.02.2026</td>
        </tr>
    </x-ui.table>
</x-ui.card>
```

---

## 💬 7. Modal Komponenta

### Parametri

| Parametar | Tip | Obavezno | Default | Opis |
|-----------|-----|----------|---------|------|
| `id` | string | Ne | Auto | Modal ID |
| `title` | string | Ne | - | Modal naslov |
| `size` | string | Ne | - | Veličina (sm, lg, xl) |
| `static` | boolean | Ne | `false` | Static backdrop |

### Primjeri

```blade
<!-- Osnovni Modal -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    Otvori Modal
</button>

<x-ui.modal id="basicModal" title="Naslov Modala">
    <p>Sadržaj modala...</p>
</x-ui.modal>

<!-- Modal S Footer Buttonima -->
<x-ui.modal id="confirmModal" title="Potvrda akcije">
    <p>Da li ste sigurni da želite nastaviti?</p>
    
    <x-slot name="footer">
        <x-ui.button variant="secondary" data-bs-dismiss="modal">
            Odustani
        </x-ui.button>
        <x-ui.button variant="danger">
            Potvrdi
        </x-ui.button>
    </x-slot>
</x-ui.modal>

<!-- Veliki Modal -->
<x-ui.modal id="largeModal" title="Detaljne Informacije" size="lg">
    <div class="row">
        <div class="col-md-6">
            <h4>Lijeva strana</h4>
            <p>Sadržaj...</p>
        </div>
        <div class="col-md-6">
            <h4>Desna strana</h4>
            <p>Sadržaj...</p>
        </div>
    </div>
</x-ui.modal>

<!-- Static Modal (ne zatvara se klikom van) -->
<x-ui.modal id="importantModal" title="Važna Poruka" :static="true">
    <p>Ovo je važna poruka koja zahtijeva vašu pažnju.</p>
    
    <x-slot name="footer">
        <x-ui.button variant="primary" data-bs-dismiss="modal">
            Razumijem
        </x-ui.button>
    </x-slot>
</x-ui.modal>

<!-- Modal S Formom -->
<x-ui.modal id="addUserModal" title="Dodaj Novog Korisnika" size="lg">
    <form id="addUserForm">
        <x-ui.form-input
            name="name"
            label="Ime i prezime"
            placeholder="Ivan Horvat"
            :required="true"
        />
        
        <x-ui.form-input
            name="email"
            type="email"
            label="Email"
            placeholder="ivan@example.com"
            :required="true"
        />
        
        <x-ui.form-input
            name="phone"
            type="tel"
            label="Telefon"
            placeholder="+385 99 123 4567"
        />
    </form>
    
    <x-slot name="footer">
        <x-ui.button variant="secondary" data-bs-dismiss="modal">
            Odustani
        </x-ui.button>
        <x-ui.button variant="primary" type="submit" form="addUserForm">
            Spremi Korisnika
        </x-ui.button>
    </x-slot>
</x-ui.modal>

<!-- Modal Otvoren Programski -->
<script>
// Otvori modal
var myModal = new bootstrap.Modal(document.getElementById('myModal'));
myModal.show();

// Zatvori modal
myModal.hide();

// Event listener kad se otvori
document.getElementById('myModal').addEventListener('shown.bs.modal', function () {
    console.log('Modal opened');
});
</script>
```

---

## 🎨 Tabler Icons

### Najčešće Korištene Ikone

```html
<!-- User & Account -->
<i class="ti ti-user"></i>
<i class="ti ti-users"></i>
<i class="ti ti-user-plus"></i>
<i class="ti ti-user-check"></i>

<!-- Communication -->
<i class="ti ti-mail"></i>
<i class="ti ti-phone"></i>
<i class="ti ti-message"></i>

<!-- Actions -->
<i class="ti ti-plus"></i>
<i class="ti ti-edit"></i>
<i class="ti ti-trash"></i>
<i class="ti ti-download"></i>
<i class="ti ti-upload"></i>
<i class="ti ti-search"></i>

<!-- Status -->
<i class="ti ti-check"></i>
<i class="ti ti-x"></i>
<i class="ti ti-alert-circle"></i>
<i class="ti ti-alert-triangle"></i>

<!-- Navigation -->
<i class="ti ti-home"></i>
<i class="ti ti-dashboard"></i>
<i class="ti ti-settings"></i>
<i class="ti ti-menu"></i>

<!-- Business -->
<i class="ti ti-shopping-cart"></i>
<i class="ti ti-credit-card"></i>
<i class="ti ti-chart-line"></i>
<i class="ti ti-file-invoice"></i>
```

**Sve ikone:** https://tabler-icons.io/

---

## 📚 Dodatni Tabler Utility Classes

### Spacing

```html
<div class="mb-3">Margin bottom 3</div>
<div class="mt-4">Margin top 4</div>
<div class="p-3">Padding 3</div>
```

### Colors

```html
<span class="text-primary">Primary text</span>
<span class="text-success">Success text</span>
<span class="text-danger">Danger text</span>
<span class="bg-primary">Primary background</span>
```

### Badges

```html
<span class="badge bg-primary">Primary</span>
<span class="badge bg-success">Success</span>
<span class="badge bg-warning">Warning</span>
<span class="badge bg-danger">Danger</span>
```

### Avatar

```html
<span class="avatar">IH</span>
<span class="avatar avatar-sm">IH</span>
<span class="avatar avatar-lg">IH</span>
<span class="avatar bg-primary text-white">IH</span>
```

---

**Za više informacija pogledaj:**
- [Tabler Dokumentacija](https://tabler.io/docs)
- [README.md](README.md)
- [QUICK-REFERENCE.md](QUICK-REFERENCE.md)
