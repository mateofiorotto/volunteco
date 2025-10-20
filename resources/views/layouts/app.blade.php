<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Volunteco') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <!-- Usuario autenticado -->
                            <li class="nav-item">
                                <x-nav-link :route="'home'">Home</x-nav-link>
                            </li>
                            @if (Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <x-nav-link :route="'list-verify-hosts'">Anfitriones</x-nav-link>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('host'))
                                <li class="nav-item">
                                    <x-nav-link :route="'my-projects.index'">Mis Proyectos</x-nav-link>
                                </li>
                            @endif

                        </ul>
                        <div class="d-flex gap-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">Salir</button>
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
        <footer class="bg-primary text-white border-top border-white mt-auto">
            <div class="container mx-auto">
                <!-- Sección superior: logo y links -->
                <div class="row align-items-center justify-content-between py-3">
                    <div class="col-md-4">
                        <a href="{{ route('home') }}" class="mb-3 d-inline-block">
                            <img src="{{ asset('images/logo-white.svg') }}" alt="Logo Volunteco" width="140" height="29">
                        </a>
                        <p class="mb-0">Cuidemos juntos el medioambiente.</p>
                    </div>

                    <!-- Enlaces -->
                    <div class="col-md-4">
                        <ul class="d-flex flex-row align-items-center justify-content-center gap-5 list-unstyled mb-0">
                            <li>
                                <x-nav-link :route="'register-host.store'">¿Querés ser Anfitrión?</x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :route="'register-volunteer.store'">¿Querés ser Voluntario?</x-nav-link>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <ul class="d-flex flex-row justify-content-end gap-4 list-unstyled mb-0">
                            <li>
                                <a href="https://www.instagram.com/volunteco" target="_blank" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/volunteco" target="_blank" class="text-white fs-5">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/volunteco" target="_blank" class="text-white fs-5">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/mateofiorotto/volunteco-social" target="_blank" class="text-white fs-5">
                                    <i class="bi bi-github"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- copyright -->
            <div class="text-center p-3 text-bg-dark">
                <p class="mb-0 small fw-light">&copy Copyright 2025 - Volunteco</p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
