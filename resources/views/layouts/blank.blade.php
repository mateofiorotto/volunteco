<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title' , 'Bienvenido') | Volunteco</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <main>
        @yield('content')
    </main>
        <!-- Footer -->
    <footer class="landing-footer text-bg-dark">
        <div class="container py-4 text-center">
            <p class="mb-0">© 2025 Volunteco. Todos los derechos reservados. | <a href="{{ route('home') }}" class="link-primary fw-semibold">Ir a la Plataforma</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
