<a {{ $attributes->merge([
        'class' => 'nav-link ' . (request()->routeIs($route) ? 'active' : '')
    ]) }} href="{{ route($route) }}">
    {{ $slot }}
</a>
