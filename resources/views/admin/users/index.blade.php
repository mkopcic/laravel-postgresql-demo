<x-layouts.app title="Korisnici — {{ config('app.name') }}">
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
                        <h2 class="page-title">Upravljanje korisnicima</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <span class="text-secondary">
                            {{ $users->total() }} {{ Str::plural('korisnik', $users->total()) }}
                        </span>
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

                <x-ui.card>
                    <x-slot name="header">
                        <h3 class="card-title">
                            <i class="ti ti-users me-2"></i>
                            Popis korisnika
                        </h3>
                    </x-slot>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-hover">
                            <thead>
                                <tr>
                                    <th>Korisnik</th>
                                    <th>Email</th>
                                    <th>Uloga</th>
                                    <th>Registriran</th>
                                    <th>Promijeni ulogu</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-sm bg-secondary-lt me-2">
                                                    <i class="ti ti-user"></i>
                                                </span>
                                                <div class="flex-fill">
                                                    <div class="fw-medium">{{ $user->name }}</div>
                                                    @if ($user->id === auth()->id())
                                                        <small class="text-secondary">(ja)</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-secondary">{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge {{ $role->name === 'admin' ? 'text-bg-danger' : 'text-bg-primary' }}">
                                                    {{ ucfirst($role->name) }}
                                                </span>
                                            @endforeach
                                            @if ($user->roles->isEmpty())
                                                <span class="badge text-bg-warning">Bez uloge</span>
                                            @endif
                                        </td>
                                        <td class="text-secondary">
                                            {{ $user->created_at->format('d.m.Y.') }}
                                        </td>
                                        <td>
                                            @if ($user->id !== auth()->id())
                                                <form
                                                    action="{{ route('admin.users.assign-role', $user) }}"
                                                    method="POST"
                                                    class="d-flex gap-2 align-items-center"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="role" class="form-select form-select-sm" style="min-width: 110px;">
                                                        @foreach ($roles as $role)
                                                            <option
                                                                value="{{ $role->name }}"
                                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}
                                                            >
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-secondary small">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}"
                                                data-action="{{ route('admin.users.update', $user) }}"
                                                title="Uredi podatke"
                                            >
                                                <i class="ti ti-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-secondary py-4">
                                            Nema korisnika u sustavu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($users->hasPages())
                        <div class="card-footer d-flex align-items-center">
                            {{ $users->links() }}
                        </div>
                    @endif
                </x-ui.card>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        {{-- Edit User Modal --}}
        <div class="modal modal-blur fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="ti ti-user-edit me-2"></i>
                                Uredi korisnika
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>

                        <div class="modal-body">
                            <x-ui.form-input
                                name="name"
                                id="edit_name"
                                label="Ime i prezime"
                                placeholder="Ivan Horvat"
                                icon="ti ti-user"
                                :required="true"
                                :error="$errors->first('name')"
                            />
                            <x-ui.form-input
                                name="email"
                                id="edit_email"
                                type="email"
                                label="Email adresa"
                                placeholder="vas@email.com"
                                icon="ti ti-mail"
                                :required="true"
                                :error="$errors->first('email')"
                            />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">
                                Odustani
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-2"></i>
                                Spremi promjene
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('editUserModal').addEventListener('show.bs.modal', function (event) {
                const btn    = event.relatedTarget;
                const form   = document.getElementById('editUserForm');

                form.action                                  = btn.dataset.action;
                document.getElementById('edit_name').value  = btn.dataset.userName;
                document.getElementById('edit_email').value = btn.dataset.userEmail;
            });
        </script>
    </x-slot>
</x-layouts.app>
