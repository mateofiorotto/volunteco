<x-layout-admin>
    <section>
        <h2>Perfiles rechazados o deshabilitados</h2>

    <article>
        <p>Perfiles rechazados</p>
        @if ($hostsDisabled->isEmpty())
                <p>No hay perfiles de anfitriones rechazados</p>
            @else
                <ul>
                    @foreach ($hostsDisabled as $hostDisabled)
                        <li class="bg-red-500 p-4 text-xl uppercase font-bold text-white">
                             <a href="{{ route('verify-host-profile', $hostDisabled->id) }}">
                                {{ $hostDisabled->host->name ?? 'Sin nombre de host' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
    </article>

    <article>
        <h2>Perfiles no verificados</h2>
        <div>
            @if ($hostsNotVerified->isEmpty())
                <p>No hay perfiles de anfitriones para verificar</p>
            @else
                <ul>
                    @foreach ($hostsNotVerified as $hostNotVerified)
                        <li class="bg-yellow-500 p-4 text-xl uppercase font-bold text-white">
                             <a href="{{ route('verify-host-profile', $hostNotVerified->id) }}">
                                {{ $hostNotVerified->host->name ?? 'Sin nombre de host' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </article>

    <article>
        <h2>Perfiles verificados</h2>
        <div>
            @if ($hostsVerified->isEmpty())
                <p>No hay perfiles de anfitriones verificados</p>
            @else
                <ul>
                    @foreach ($hostsVerified as $hostVerified)
                        <li class="bg-green-600 p-4 text-xl uppercase font-bold text-white">
                            <a href="{{ route('verify-host-profile', $hostVerified->id) }}">
                                {{ $hostVerified->host->name ?? 'Sin nombre de host' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </article>
    </section>
</x-layout-admin>
