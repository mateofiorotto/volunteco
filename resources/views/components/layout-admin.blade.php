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

                        <li>
                            <x-nav-link :route="'home'">Volver</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :route="'list-verify-hosts'"
                                        class="hover:text-light">Lista anfitriones</x-nav-link>
                        </li>
                        <li>
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="btn text-sm">Logout</button>
                            </form>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<main>
    {{ $slot }}
</main>

</body>