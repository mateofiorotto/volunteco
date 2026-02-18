@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Perfil <span>del anfitrión</span></h1>
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>

        <!-- Perfil -->
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-start">
                            <!-- Foto de perfil -->
                            <div class="avatar">
                                <img src="{{ asset('storage/' . ($host->avatar ?? 'perfil-host.svg')) }}"
                                     alt="Foto de perfil de {{ $host->name }}"
                                     class="rounded-circle object-fit-contain avatar-lg"
                                     width="200"
                                     height="200" />
                            </div>

                            <!-- Info (nombre, editar (si el perfil es propio), localidad) -->
                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $host->name }}</h2>
                                <!-- Info Grid -->
                                @if ($host->location_id)
                                    <div class="d-flex align-items-start">
                                        <p>{{ $host->location->name }} - {{ $host->location->province->name }}</p>
                                    </div>
                                @endif

                                <!-- Descripción -->
                                <div>
                                    <h3 class="card-title h5">Descripción</h3>
                                    <p class="text-muted mb-0 small">{{ $host->description }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                @if($isAceptedByHost)
                <div class="card mb-4">
                    <div class="card-header">Contacto</div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li>Persona de contacto: <span class="text-muted">{{ $host->person_full_name }}</span></li>
                            <li>Teléfono: <span class="text-muted">{{ $host->phone }}</span></li>
                            <li>Email: <span class="text-muted"> <a href="mailto:{{ $host->user->email }}" target="_blank">{{ $host->user->email }}</a></span></li>
                        </ul>
                    </div>
                </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">Redes sociales</div>
                    <div class="card-body">
                        <!-- Redes -->
                        @if ($host->linkedin || $host->facebook || $host->instagram)
                            <ul class="list-unstyled mb-0">
                                @if ($host->linkedin)
                                    <li>
                                        <a href="{{ $host->linkedin }}"
                                           target="_blank">
                                            <i class="bi bi-linkedin fs-5 me-2 text-azul align-middle"></i>
                                            {{ $host->linkedin }}
                                        </a>
                                    </li>
                                @endif
                                @if ($host->facebook)
                                    <li>
                                        <a href="{{ $host->facebook }}"
                                           target="_blank">
                                            <i class="bi bi-facebook fs-5 me-2 text-azul align-middle"></i>
                                            {{ $host->facebook }}
                                        </a>
                                    </li>
                                @endif
                                @if ($host->instagram)
                                    <li>
                                        <a href="{{ $host->instagram }}"
                                           target="_blank">
                                            <i class="bi bi-instagram fs-5 me-2 text-azul align-middle"></i>
                                            {{ $host->instagram }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">Otros proyectos del anfitrión</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Tu solicitud de aplicación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($host->projects as $project)
                                    <tr class="align-middle {{ $project->enabled === 0 ? 'table-danger' : '' }}">
                                        <td>
                                            {{ $project->title }}
                                            @if ($project->enabled === 0)
                                                <span class="badge text-bg-danger">Deshabilitado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>Inicia: <span class="small text-muted">{{ $project->start_date->format('d/m/Y') }}</span></div>
                                            <div>Finaliza: <span class="small text-muted">{{ $project->end_date->format('d/m/Y') }}</span></div>
                                        </td>
                                        <td>{{ $project->location->name }} - {{ $project->location->province->name }}</td>
                                        <td class="text-center">
                                            @php
                                                $currentVolunteer = auth()->user()->volunteer;
                                                $myApplication = $project->volunteers->firstWhere('id', $currentVolunteer->id);
                                            @endphp
                                            @if($myApplication && $myApplication->pivot->status !== 'aceptado')
                                                <span class="badge text-capitalize {{ $myApplication->pivot->status == 'pendiente' ? 'bg-warning text-bg-warning' : 'bg-danger' }}"> {{ $myApplication->pivot->status }}</span>
                                            @endif
                                            @if($myApplication && $myApplication->pivot->status == 'aceptado')
                                            <span class="badge text-capitalize bg-transparent text-body">{{$myApplication->pivot->status}}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('project', $project->id) }}"
                                            class="btn btn-azul btn-sm @if ($project->enabled === 0) disabled @endif">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
