<button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarMenu"
        aria-controls="navbarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse align-items-lg-center" id="navbarMenu">
    @guest
        <div class="d-flex gap-3">
            <!-- Usuario NO autenticado -->
            <a class="btn btn-primary {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Ingresar</a>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Regístrate
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('register-host.create') ? 'active' : '' }}" href="{{ route('register-host.create') }}">¿Querés ser Anfitrión?</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('register-volunteer.create') ? 'active' : '' }}" href="{{ route('register-volunteer.create') }}">¿Querés ser Voluntario?</a></li>
                </ul>
            </div>
        </div>
    @else
        <!-- esto es solo en modo desarrollo sacar despues en produccion -->
        <div class="d-flex align-items-center"><p class="mb-0">Hola {{ Auth::user()->role->name }}</p></div>
        <a href="{{route('home')}}" class="btn btn-outline-primary ms-auto me-4">Ir al sitio web</a>
        <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">

            <!-- Usuario autenticado -->
            @if (Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/anfitriones*') ? 'active' : '' }}"
                       href="{{ route('admin.hosts.index') }}">Anfitriones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/voluntarios*') ? 'active' : '' }}"
                       href="{{ route('admin.volunteers.index') }}">Voluntarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/proyectos*') ? 'active' : '' }}"
                       href="{{ route('admin.projects.index') }}">Proyectos</a>
                </li>
            @endif
            @if (Auth::user()->hasRole('host'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('host.dashboard') ? 'active' : '' }}" href="{{ route('host.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('usuario/anfitrion/mis-proyectos*') ? 'active' : '' }}" href="{{ route('host.my-projects.index') }}">Mis Proyectos</a>
                </li>
            @endif
            @if (Auth::user()->hasRole('volunteer'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('volunteer.dashboard') ? 'active' : '' }}" href="{{ route('volunteer.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('volunteer.projects.applied') ? 'active' : '' }}" href="{{ route('volunteer.projects.applied') }}">Mis Proyectos</a>
                </li>
            @endif
            <li class="nav-item dropdown dropdown-center">
                @if(Auth::user()->hasRole('volunteer'))
                <a class="nav-link dropdown-toggle {{ request()->is('usuario/voluntario/mi-perfil*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('storage/perfil-volunteer.svg')}}" width="40" height="40"/>
                </a>
                <ul class="dropdown-menu pb-0">
                    <li><a class="dropdown-item" href="{{ route('volunteer.my-profile.profile') }}">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider mb-0"></li>
                    <li class="p-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                        </form>
                    </li>
                </ul>
                @elseif(Auth::user()->hasRole('host'))
                <a class="nav-link dropdown-toggle {{ request()->is('usuario/anfitrion/mi-perfil*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('storage/perfil-host.svg')}}" width="40" height="40"/>
                </a>
                <ul class="dropdown-menu pb-0">
                    <li><a class="dropdown-item" href="{{ route('host.my-profile.profile') }}">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider mb-0"></li>
                    <li class="p-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                        </form>
                    </li>
                </ul>
                @else
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('storage/perfil-volunteer.svg')}}" width="40" height="40"/>
                </a>
                <ul class="dropdown-menu py-0">
                    <li class="p-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                        </form>
                    </li>
                </ul>
                @endif
            </li>
        </ul>
    @endguest
</div>
