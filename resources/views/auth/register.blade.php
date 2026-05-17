<x-layouts.auth title="Registracija — {{ config('app.name') }}">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
                <h2 class="mb-0">{{ config('app.name', 'Laravel') }}</h2>
            </a>
        </div>

        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Kreiraj novi račun</h2>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-alert-circle icon me-2"></i></div>
                            <div>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" autocomplete="off" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Ime i prezime</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ivan Horvat"
                            required
                            autofocus
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email adresa</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="vas@email.com"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Lozinka</label>
                        <div class="input-group input-group-flat">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min. 8 znakova"
                                required
                            >
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Prikaži lozinku"
                                   onclick="togglePassword(event)">
                                    <i class="ti ti-eye icon"></i>
                                </a>
                            </span>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Potvrda lozinke</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ponovi lozinku"
                            required
                        >
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-user-plus me-2"></i>
                            Registriraj se
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center text-secondary mt-3">
            Već imaš račun?
            <a href="{{ route('login') }}">Prijavi se</a>
        </div>
    </div>

    <script>
        function togglePassword(e) {
            e.preventDefault();
            const input = document.getElementById('password');
            const icon = e.currentTarget.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ti-eye', 'ti-eye-off');
            } else {
                input.type = 'password';
                icon.classList.replace('ti-eye-off', 'ti-eye');
            }
        }
    </script>
</x-layouts.auth>
