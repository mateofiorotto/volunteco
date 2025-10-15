<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-white py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2">
                    <h1 class="sr-only">Volunteco</h1>
                    <img src="{{ asset('images/logo.svg') }}"
                         alt="Logo Volunteco"
                         class="h-8">
                </a>

                <!-- Botón hamburguesa -->
                <button id="menu-btn"
                        class="p-2 rounded-lg md:hidden text-gray-700 focus:outline-none"
                        aria-label="Abrir menú de navegación">
                    <svg class="w-6 h-6"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 17 14">
                        <path stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

                <!-- Menú -->
                <div id="navbar-default"
                     class="hidden md:block absolute md:relative top-14 md:top-auto right-0 md:right-auto bg-white md:bg-transparent w-full md:w-auto shadow-md md:shadow-none border-t md:border-0 z-50">
                    <ul class="flex flex-col md:flex-row gap-4 md:items-center items-end p-4 md:p-0 text-gray-800">

                        @guest
                            <!-- Usuario NO autenticado -->
                            <li>
                                <x-nav-link :route="'login'">Iniciar sesión</x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :route="'register-host.store'">Registrarse como anfitrión</x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :route="'register-volunteer.store'">Registrarse como voluntario</x-nav-link>
                            </li>
                        @else
                            <!-- Usuario autenticado -->
                            <li>
                                <x-nav-link :route="'home'">Inicio</x-nav-link>
                            </li>
                            @if (Auth::user()->user_type == 'Admin')
                                <li>
                                    <x-nav-link :route="'list-verify-hosts'"
                                                class="hover:text-light">Administracion</x-nav-link>
                                </li>
                            @endif
                            <li>
                                <form method="POST"
                                      action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="btn text-sm">Logout</button>
                                </form>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>
    <footer class="bg-[#66800A] text-white py-6 border-t border-white">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Sección superior: logo y links -->
            <div class="flex flex-col md:flex-row gap-6 items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-white.svg') }}"
                         alt="Logo Volunteco"
                         class="h-12 w-auto">
                </a>

                <!-- Enlaces -->
                <ul class="flex flex-col md:flex-row items-center justify-center gap-5">
                    @auth
                        <li>
                            <x-nav-link :route="'home'"
                                        class="hover:text-light">Inicio</x-nav-link>
                        </li>
                        <li>
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="btn text-sm hover:text-light">Logout</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <x-nav-link :route="'login'"
                                        class="hover:text-light">Iniciar sesión</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :route="'register-host.store'"
                                        class="hover:text-light">Registrarse como anfitrión</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :route="'register-volunteer.store'"
                                        class="hover:text-light">Registrarse como voluntario</x-nav-link>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Línea divisoria -->
            <div class="border-t border-white mt-5 pt-5"></div>

            <!-- Sección inferior -->
            <div
                 class="flex flex-col md:flex-row gap-3 text-center md:text-left justify-center md:justify-between items-center">
                <p>
                    Cuidemos al medioambiente.<br>
                    Herminia Bento y Mateo Fiorotto.
                </p>

                <ul class="flex flex-row justify-center gap-7 text-3xl">
                    <li>
                        <a href="https://www.instagram.com/volunteco"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-light">
                            <i class="fa-brands fa-instagram">
                                <span class="sr-only">Instagram</span>
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/volunteco"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-light">
                            <i class="fa-brands fa-facebook">
                                <span class="sr-only">Facebook</span>
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/volunteco"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-light">
                            <i class="fa-brands fa-x-twitter">
                                <span class="sr-only">Twitter</span>
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/mateofiorotto/volunteco-social"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-light">
                            <i class="fa-brands fa-github">
                                <span class="sr-only">GitHub</span>
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>
