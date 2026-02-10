<button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarMenu"
        aria-controls="navbarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse"
     id="navbarMenu">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
               href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('howItWorks') ? 'active' : '' }}"
               href="{{ route('howItWorks') }}">Cómo funciona</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('projects', 'project') ? 'active' : '' }}"
               href="{{ route('projects') }}">Proyectos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
               href="{{ route('about') }}">Nosotros</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Apoyanos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item {{ request()->routeIs('donate') ? 'active' : '' }}"
               href="{{ route('donate') }}">Donar</a></li>
            <li>
                <a class="dropdown-item d-flex justify-content-between {{ request()->routeIs('shop') ? 'active' : '' }}"
                   href="{{ route('shop') }}">Tienda
                   <div class="text-azul fw-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="21" height="21" class="align-middle mb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span id="cart-count" class="small cart-count">0</span>
                    </div>
                </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
               href="{{ route('contact') }}">Contacto</a>
        </li>
    </ul>
    @guest
        <div class="d-md-none pb-3">
            <a class="btn btn-outline-primary w-100 mb-3 py-2"
               href="{{ route('login') }}">Ingresar</a>
            <div class="d-flex gap-3">
                <a class="btn btn-primary"
                   href="{{ route('register-host.create') }}">¿Querés ser anfitrión?</a>
                <a class="btn btn-primary"
                   href="{{ route('register-volunteer.create') }}">¿Querés ser voluntario?</a>
            </div>
        </div>

        <div class="d-md-flex align-items-center d-none">
            <!-- Usuario NO autenticado -->
            <a class="py-0 px-3 {{ request()->routeIs('login') ? 'active' : '' }}"
               href="{{ route('login') }}">
                <img src="{{ asset('storage/perfil-volunteer.svg') }}"
                     width="40"
                     height="40"
                     alt="Avatar voluntario" />
            </a>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Registrate
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('register-host.create') ? 'active' : '' }}"
                           href="{{ route('register-host.create') }}">¿Querés ser anfitrión?</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('register-volunteer.create') ? 'active' : '' }}"
                           href="{{ route('register-volunteer.create') }}">¿Querés ser voluntario?</a></li>
                </ul>
            </div>
        </div>
    @else
        <!-- esto es solo en modo desarrollo sacar despues en produccion -->
        <div class="navbar-nav mb-2 mb-lg-0">
            <!-- Usuario autenticado -->
            @if (Auth::user()->hasRole('admin'))
                <div class="dropdown">
                    <a class="dropdown-toggle p-2"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ asset('storage/perfil-volunteer.svg') }}"
                             width="40"
                             height="40"
                             alt="avatar voluntario" />
                    </a>
                    <ul class="dropdown-menu pb-0">
                        <li><a class="dropdown-item"
                               href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider mb-0">
                        </li>
                        <li class="p-0">
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            @if (Auth::user()->hasRole('host'))
                <div class="dropdown">
                    <a class="dropdown-toggle p-2"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ asset('storage/perfil-host.svg') }}"
                             width="40"
                             height="40"
                             alt="Avatar anfitrión" />
                    </a>
                    <ul class="dropdown-menu pb-0">
                        <li><a class="dropdown-item"
                               href="{{ route('host.dashboard') }}">Mi cuenta</a></li>
                        <li><a class="dropdown-item"
                               href="{{ route('host.my-profile.profile') }}">Mi perfil</a></li>
                        <li>
                            <hr class="dropdown-divider mb-0">
                        </li>
                        <li class="p-0">
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            @if (Auth::user()->hasRole('volunteer'))
                <div class="dropdown">
                    <a class="dropdown-toggle p-2"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ asset('storage/perfil-volunteer.svg') }}"
                             width="40"
                             height="40"
                             alt="Avatar voluntario" />
                    </a>
                    <ul class="dropdown-menu pb-0">
                        <li><a class="dropdown-item"
                               href="{{ route('volunteer.dashboard') }}">Mi cuenta</a></li>
                        <li><a class="dropdown-item"
                               href="{{ route('volunteer.my-profile.profile') }}">Mi perfil</a></li>
                        <li>
                            <hr class="dropdown-divider mb-0">
                        </li>
                        <li class="p-0">
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link w-100 rounded-0 text-start py-2 px-3">Salir</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    @endguest
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.updateCartCount) {
            updateCartCount();
        }
    });
</script>
@endpush
