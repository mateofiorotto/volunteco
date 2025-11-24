<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title' , auth()->user()->role->name) | Admin Volunteco</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="d-flex h-100">
    <div class="d-flex w-100 h-100 mx-auto flex-column">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand"
                       href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.svg') }}"
                             alt="Logo Volunteco"
                             class="navbar-brand"
                             width="200"
                             height="51">
                    </a>
                    @include('partials.admin-navbar')
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="border-top border-white mt-auto">
            <!-- copyright -->
            <div class="text-center p-3 text-bg-dark">
                <p class="mb-0 small fw-light">&copy Copyright 2025 - Volunteco</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @yield('modals')

    @yield('scripts')
</body>

</html>
