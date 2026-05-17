<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css");
    </style>
</head>
<body class="d-flex flex-column antialiased">
    <div class="page page-center">
        {{ $slot }}
    </div>

    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}" defer></script>
</body>
</html>
