
<section>
    <h2>Perfiles no verificados</h2>
    <div>
        @if ($hostsNotVerified->isEmpty())
            <p>No hay perfiles de anfitriones para verificar</p>
        @else
            <ul>
                @foreach($hostsNotVerified as $hostNotVerified)
                    <li class="bg-red-500">
                        <a href="/admin/verificar-perfil-anfitrion/{{ $hostNotVerified->id }}">
                            {{ $hostNotVerified->host->name ?? 'Sin nombre de host' }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

<section>
    <h2>Perfiles verificados</h2>
    <div>
        @if ($hostsVerified->isEmpty())
            <p>No hay perfiles de anfitriones verificados</p>
        @else
            <ul>
                @foreach($hostsVerified as $hostVerified)
                    <li class="bg-green-600 p-4 ">
                        <a href="/admin/verificar-perfil-anfitrion/{{ $hostVerified->id }}">
                            {{ $hostVerified->host->name ?? 'Sin nombre de host' }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>