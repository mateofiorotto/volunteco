<a {{ $attributes->merge([
        'class' => 'nav-link ' . (request()->routeIs($route) ? 'active' : '')
    ]) }} href="{{ $route ? route($route) : '#' }}">
    {{ $slot }}
</a>
