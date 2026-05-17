<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>@yield('code') — @yield('title') | {{ config('app.name') }}</title>

    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css");
    </style>
    <script src="{{ asset('tabler/dist/js/tabler-theme.min.js') }}"></script>
</head>
<body class="d-flex flex-column antialiased">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="empty">
                <div class="empty-header @yield('color', 'text-muted')">@yield('code')</div>

                <div class="mb-3">
                    <span class="avatar avatar-lg @yield('avatar-bg', 'bg-secondary-lt') @yield('color', 'text-muted')">
                        <i class="ti @yield('icon', 'ti-alert-circle') fs-1"></i>
                    </span>
                </div>

                <p class="empty-title">@yield('message')</p>
                <p class="empty-subtitle text-secondary">
                    @yield('description', 'Nešto je pošlo po krivu. Pokušaj se vratiti natrag.')
                </p>

                <div class="empty-action">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left me-2"></i>Natrag na Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left me-2"></i>Natrag na Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="ti ti-home me-2"></i>Na početnu stranicu
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}" defer></script>
</body>
</html>
