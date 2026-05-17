<x-layouts.app title="Dashboard — {{ config('app.name') }}">
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
                        <div class="page-pretitle">Dobrodošao/la</div>
                        <h2 class="page-title">{{ $user->name }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">

                @if (session('success'))
                    <x-ui.alert type="success" :dismissible="true" class="mb-3">
                        {{ session('success') }}
                    </x-ui.alert>
                @endif

                <!-- Placeholder kartice -->
                <div class="row row-deck row-cards mb-3">
                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-blue-lt avatar me-3">
                                    <i class="ti ti-calendar-stats"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Aktivan od</div>
                                    <div class="fw-bold">{{ $user->created_at->format('d.m.Y.') }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-green-lt avatar me-3">
                                    <i class="ti ti-activity"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Aktivnosti</div>
                                    <div class="fw-bold">{{ $activities->count() }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-purple-lt avatar me-3">
                                    <i class="ti ti-shield"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Uloga</div>
                                    <div class="fw-bold">{{ ucfirst($user->roles->first()?->name ?? '—') }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                <div class="row row-deck row-cards">
                    <!-- Aktivnosti -->
                    <div class="col-lg-7">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">
                                    <i class="ti ti-history me-2"></i>
                                    Moje aktivnosti
                                </h3>
                            </x-slot>

                            @if ($activities->isEmpty())
                                <div class="text-center text-secondary py-4">
                                    <i class="ti ti-mood-empty" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0">Još nema zabilježenih aktivnosti.</p>
                                </div>
                            @else
                                <x-ui.table :headers="['Aktivnost', 'Datum']">
                                    @foreach ($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->description }}</td>
                                            <td class="text-secondary">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-ui.table>
                            @endif
                        </x-ui.card>
                    </div>

                    <!-- Profil forma -->
                    <div class="col-lg-5">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">
                                    <i class="ti ti-user-edit me-2"></i>
                                    Uredi profil
                                </h3>
                            </x-slot>

                            <form action="{{ route('user.profile.update') }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                <x-ui.form-input
                                    name="name"
                                    label="Ime i prezime"
                                    :value="old('name', $user->name)"
                                    placeholder="Vaše ime"
                                    icon="ti ti-user"
                                    :required="true"
                                    :error="$errors->first('name')"
                                />

                                <x-ui.form-input
                                    name="email"
                                    type="email"
                                    label="Email adresa"
                                    :value="old('email', $user->email)"
                                    placeholder="vas@email.com"
                                    icon="ti ti-mail"
                                    :required="true"
                                    :error="$errors->first('email')"
                                />

                                <hr class="my-3">
                                <p class="text-secondary small mb-2">Ostavi prazno da ne mijenjаš lozinku</p>

                                <x-ui.form-input
                                    name="password"
                                    type="password"
                                    label="Nova lozinka"
                                    placeholder="Min. 8 znakova"
                                    icon="ti ti-lock"
                                    :error="$errors->first('password')"
                                />

                                <x-ui.form-input
                                    name="password_confirmation"
                                    type="password"
                                    label="Potvrda lozinke"
                                    placeholder="Ponovi lozinku"
                                    icon="ti ti-lock-check"
                                />

                                <x-ui.button variant="primary" type="submit" class="w-100">
                                    <i class="ti ti-device-floppy me-2"></i>
                                    Spremi promjene
                                </x-ui.button>
                            </form>
                        </x-ui.card>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
