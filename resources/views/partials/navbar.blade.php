<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarMenu">
    @guest
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
        <li class="nav-item">
            <x-nav-link :route="'home'">Inicio</x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link :route="'projects'">Proyectos</x-nav-link>
        </li>
    </ul>
    <div class="d-flex gap-3">
        <!-- Usuario NO autenticado -->
        <a class="btn btn-outline-primary" href="{{ route('login')}}">Ingresar</a>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Registrate
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('register-host.create') }}">¿Querés ser Anfitrión?</a></li>
                <li><a class="dropdown-item" href="{{ route('register-volunteer.create') }}">¿Querés ser Voluntario?</a></li>
            </ul>
        </div>
    </div>
    @else
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
        <!-- Usuario autenticado -->
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <x-nav-link :route="'admin.dashboard'">Dashboard</x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="'admin.hosts.index'">Anfitriones</x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="'admin.volunteers.index'">Voluntarios</x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="null">Proyectos</x-nav-link>
            </li>
        @endif
        @if (Auth::user()->hasRole('host'))
            <li class="nav-item">
                <x-nav-link :route="'hosts.dashboard'">Dashboard</x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="'hosts.my-projects.index'">Mis Proyectos</x-nav-link>
            </li>
            <x-nav-link :href="route('hosts.host-profile', ['id' => Auth::user()->host->id])">
                    Mi Perfil
               </x-nav-link>
        @endif
        @if (Auth::user()->hasRole('volunteer'))
            <li class="nav-item">
                <x-nav-link :route="'volunteers.dashboard'">Dashboard</x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="'projects'">Proyectos</x-nav-link>
            </li>
            <li class="nav-item">
                <!-- mio perfil -->
               <x-nav-link :href="route('volunteers.volunteer-profile', ['id' => Auth::user()->volunteer->id])">
                    Mi Perfil
               </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link :route="'volunteers.projects.applied'">Mis Postulaciones</x-nav-link>
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