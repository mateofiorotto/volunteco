<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Volunteco') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Volunteco" class="navbar-brand" width="150" height="auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        @guest
                            <!-- Usuario NO autenticado -->
                            <li class="nav-item">
                                <x-nav-link :route="'login'">Iniciar sesión</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link :route="'register-host.store'">Registrarse como anfitrión</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link :route="'register-volunteer.store'">Registrarse como voluntario</x-nav-link>
                            </li>
                        @else
                            <!-- Usuario autenticado -->
                            <li class="nav-item">
                                <x-nav-link :route="'home'">Inicio</x-nav-link>
                            </li>
                            @if (Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <x-nav-link :route="'list-verify-hosts'">Lista anfitriones</x-nav-link>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Logout</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    <footer class="bg-primary text-white py-3 border-top border-white">
        <div class="container mx-auto">
            <!-- Sección superior: logo y links -->
            <div class="d-flex flex-col flex-nd-row gap-5 align-items-center justify-content-between mb-4">
                <!-- Logo -->
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-white.svg') }}" alt="Logo Volunteco" width="140" height="29">
                </a>

                <!-- Enlaces -->
                <ul class="d-flex flex-col flex-md-row align-items-center justify-content-center gap-5 list-unstyled mb-0">
                    @auth
                        <li>
                            <x-nav-link :route="'home'">Inicio</x-nav-link>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn text-sm hover:text-light">Logout</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <x-nav-link :route="'login'">Iniciar sesión</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :route="'register-host.store'">Registrarse como anfitrión</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :route="'register-volunteer.store'">Registrarse como voluntario</x-nav-link>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Sección inferior -->
            <div class="d-flex flex-col flex-md-row gap-3 text-center text-md-left justify-content-center justify-content-md-between align-items-center">
                <p class="mb-0">Cuidemos al medioambiente.</p>

                <ul class="d-flex flex-row justify-content-center gap-5 list-unstyled mb-0">
                    <li>
                        <a href="https://www.instagram.com/volunteco" target="_blank"><i class="bi bi-instagram"></i></a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/volunteco" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/volunteco">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/mateofiorotto/volunteco-social" target="_blank">
                            <i class="bi bi-github"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>
