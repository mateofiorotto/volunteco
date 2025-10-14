@php
    $hostsNotNotified = $hostsDisabled->filter(function ($host) {
        return $host->host && $host->host->notified == false;
    });

    $hostsNotified = $hostsDisabled->filter(function ($host) {
        return $host->host && $host->host->notified == true;
    });
@endphp

<x-layout-admin>
    <section>
        <h2>Perfiles rechazados o deshabilitados</h2>
        <div>
            <p>Perfiles sin notificar</p>
            @if ($hostsNotNotified->where('notified', false)->isEmpty())
                <li>No hay perfiles sin notificar</li>
            @else
                <ul>
                    @foreach ($hostsNotNotified as $hostNotNotified)
                        <li class="bg-red-500 p-2 my-1 rounded">
                            <a href="{{ route('verify-host-profile', $hostNotNotified->id) }}">
                                {{ $hostNotNotified->host->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
    </section>

    <section>
        <p>Perfiles notificados</p>
        @if ($hostsNotified->isEmpty())
            <li>No hay perfiles notificados</li>
        @else
            <ul>
                @foreach ($hostsNotified as $hostNotified)
                    <li class="bg-orange-500 p-2 my-1 rounded">
                         <a href="{{ route('verify-host-profile', $hostNotified->id) }}">
                            {{ $hostNotified->host->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section>
        <h2>Perfiles no verificados</h2>
        <div>
            @if ($hostsNotVerified->isEmpty())
                <p>No hay perfiles de anfitriones para verificar</p>
            @else
                <ul>
                    @foreach ($hostsNotVerified as $hostNotVerified)
                        <li class="bg-yellow-500">
                             <a href="{{ route('verify-host-profile', $hostNotVerified->id) }}">
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
                    @foreach ($hostsVerified as $hostVerified)
                        <li class="bg-green-600 p-4 ">
                            <a href="{{ route('verify-host-profile', $hostVerified->id) }}">
                                {{ $hostVerified->host->name ?? 'Sin nombre de host' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
</x-layout-admin>
