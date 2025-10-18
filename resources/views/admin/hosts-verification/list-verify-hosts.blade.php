@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <h1>Listado de anfitriones</h1>

            <div>
                <h2 class="h3">Anfitriones deshabilitados</h2>
                <article>
                    @if ($hostsDisabled->isEmpty())
                            <p>No hay perfiles de anfitriones rechazados</p>
                        @else
                            <ul class="list-group">
                                @foreach ($hostsDisabled as $hostDisabled)
                                    <li class="list-group-item p-0 border-danger">
                                        <a href="{{ route('verify-host-profile', $hostDisabled->id) }}" class="text-decoration-none p-2 d-block">
                                            {{ $hostDisabled->host->name ?? 'Sin nombre de host' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                </article>
            </div>

            <article>
                <h2 class="h3">Perfiles no verificados</h2>
                <div>
                    @if ($hostsNotVerified->isEmpty())
                        <p>No hay perfiles de anfitriones para verificar</p>
                    @else
                        <ul>
                            @foreach ($hostsNotVerified as $hostNotVerified)
                                <li>
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
                <h2 class="h3">Perfiles verificados</h2>
                <div>
                    @if ($hostsVerified->isEmpty())
                        <p>No hay perfiles de anfitriones verificados</p>
                    @else
                        <ul>
                            @foreach ($hostsVerified as $hostVerified)
                                <li>
                                    <a href="{{ route('verify-host-profile', $hostVerified->id) }}">
                                        {{ $hostVerified->host->name ?? 'Sin nombre de host' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </article>
        </div>
    </section>
@endsection
