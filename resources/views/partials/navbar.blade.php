<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarMenu">
    @guest
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}" href="{{route('projects')}}">Proyectos</a>
        </li>
    </ul>
    <div class="d-flex gap-3">
        <!-- Usuario NO autenticado -->
        <a class="btn btn-outline-primary {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login')}}">Ingresar</a>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Registrate
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item {{ request()->routeIs('register-host.create') ? 'active' : '' }}" href="{{ route('register-host.create') }}">¿Querés ser Anfitrión?</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('register-volunteer.create') ? 'active' : '' }}" href="{{ route('register-volunteer.create') }}">¿Querés ser Voluntario?</a></li>
            </ul>
        </div>
    </div>
    @else
    <!-- esto es solo en modo desarrollo sacar despues en produccion -->
    <div>Hola {{Auth::user()->role->name}}</div>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
        <!-- Usuario autenticado -->
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/anfitriones*') ? 'active' : '' }}" href="{{route('admin.hosts.index')}}">Anfitriones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/voluntarios*') ? 'active' : '' }}" href="{{route('admin.volunteers.index')}}">Voluntarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/projectos*') ? 'active' : '' }}" href="{{route('admin.projects.index')}}">Proyectos</a>
            </li>
        @endif
        @if (Auth::user()->hasRole('host'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('host.dashboard') ? 'active' : '' }}" href="{{route('host.dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('usuario/anfitrion/mis-proyectos*') ? 'active' : '' }}" href="{{route('host.my-projects.index')}}">Mis Proyectos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('usuario/anfitrion/mi-perfil*') ? 'active' : '' }}" href="{{route('host.my-profile.show')}}">Mi Perfil</a>
            </li>
        @endif
        @if (Auth::user()->hasRole('volunteer'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('volunteer.dashboard') ? 'active' : '' }}" href="{{route('volunteer.dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('proyectos*') ? 'active' : '' }}" href="{{route('projects')}}">Proyectos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('volunteer.projects.applied') ? 'active' : '' }}" href="{{route('volunteer.projects.applied')}}">Mis Postulaciones</a>
            </li>
            <li class="nav-item">
                <!-- mio perfil -->
                <a class="nav-link {{ request()->is('usuario/voluntario/mi-perfil*') ? 'active' : '' }}" href="{{route('volunteer.my-profile.show')}}">Mi Perfil</a>
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
