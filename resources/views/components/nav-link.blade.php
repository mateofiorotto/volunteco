<a 
    class="nav-link {{ request()->routeIs($route) ? 'active fw-bold' : '' }}"
    {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!} 
    href="{{ route($route) }}">{{ $slot }}
</a>