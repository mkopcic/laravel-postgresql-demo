<x-layouts.app title="Admin Dashboard — {{ config('app.name') }}">
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
                        <div class="page-pretitle">Admin panel</div>
                        <h2 class="page-title">Dashboard</h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">
                            <i class="ti ti-users me-2"></i>
                            Upravljanje korisnicima
                        </a>
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

                <!-- Stat kartice -->
                <div class="row row-deck row-cards">
                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-primary text-white avatar me-3">
                                    <i class="ti ti-users"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Ukupno korisnika</div>
                                    <div class="h1 mb-0">{{ $stats['total_users'] }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-red text-white avatar me-3">
                                    <i class="ti ti-shield-lock"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Administratori</div>
                                    <div class="h1 mb-0">{{ $stats['admins'] }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <x-ui.card class="card-sm">
                            <div class="d-flex align-items-center">
                                <span class="bg-green text-white avatar me-3">
                                    <i class="ti ti-user-check"></i>
                                </span>
                                <div>
                                    <div class="text-secondary">Obični korisnici</div>
                                    <div class="h1 mb-0">{{ $stats['regular_users'] }}</div>
                                </div>
                            </div>
                        </x-ui.card>
                    </div>
                </div>

                <!-- Nedavne aktivnosti -->
                <div class="row row-deck row-cards mt-3">
                    <div class="col-12">
                        <x-ui.card>
                            <x-slot name="header">
                                <h3 class="card-title">
                                    <i class="ti ti-activity me-2"></i>
                                    Nedavne aktivnosti
                                </h3>
                                <div class="card-options">
                                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary">
                                        Svi korisnici
                                    </a>
                                </div>
                            </x-slot>

                            @if ($recentActivities->isEmpty())
                                <div class="text-center text-secondary py-4">
                                    <i class="ti ti-mood-empty" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0">Još nema zabilježenih aktivnosti.</p>
                                </div>
                            @else
                                <x-ui.table :headers="['Korisnik', 'Aktivnost', 'Datum', '']">
                                    @foreach ($recentActivities as $activity)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-sm bg-secondary-lt me-2">
                                                        <i class="ti ti-user"></i>
                                                    </span>
                                                    {{ $activity->causer?->name ?? 'Sustav' }}
                                                </div>
                                            </td>
                                            <td>{{ $activity->description }}</td>
                                            <td class="text-secondary">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <span class="badge bg-green-lt text-green">
                                                    <i class="ti ti-check me-1"></i>Zabilježeno
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-ui.table>
                            @endif
                        </x-ui.card>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
