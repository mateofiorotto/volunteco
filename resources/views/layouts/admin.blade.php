<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Volunteco') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="d-flex h-100">
    <div class="d-flex w-100 h-100 mx-auto flex-column">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Volunteco" class="navbar-brand" width="200" height="51">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        @guest
                        <div class="ms-auto d-flex gap-3">
                            <!-- Usuario NO autenticado -->
                            <a class="btn btn-outline-primary" href="{{ route('login')}}">Ingresar</a>

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Registrate
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('register-host.store') }}">¿Querés ser Anfitrión?</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register-volunteer.store') }}">¿Querés ser Voluntario?</a></li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                            <!-- Usuario autenticado -->
                            <li class="nav-item">
                                <x-nav-link :route="'home'">Home</x-nav-link>
                            </li>
                            @if (Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <x-nav-link :route="'list-verify-hosts'">Lista anfitriones</x-nav-link>
                                </li>
                            @endif
                        </ul>
                        <div class="d-flex gap-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">Logout</button>
                            </form>
                        </div>
                        @endguest
                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
