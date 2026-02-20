@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3">Perfil <span>del voluntario</span></h1>
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                <strong>¡Perfecto!</strong> {{ session('success') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        <!-- Perfil -->
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-start">
                            <!-- Foto de perfil -->
                            <div class="avatar">
                                <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                     alt="Foto de perfil de {{ $volunteer->full_name }}"
                                     class="rounded-circle object-fit-contain avatar-lg"
                                     width="200"
                                     height="200">
                            </div>

                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $volunteer->full_name }}</h2>
                                <!-- Info Grid -->
                                @if ($volunteer->location_id)
                                    <div class="d-flex align-items-start">
                                        <p>{{ $volunteer->location->name }} - {{ $volunteer->location->province->name }}</p>
                                    </div>
                                @endif
                                <ul class="list-unstyled mb-0">
                                    @if ($volunteer->birthdate)
                                        <li><span class="text-muted">{{ $volunteer->birthdate->age }} años</span></li>
                                    @endif
                                    <li>Profesión: <span class="text-capitalize text-muted">{{ $volunteer->profession }}</span></li>
                                    <li>Nivel educativo: <span class="text-muted text-capitalize">{{ $volunteer->educational_level }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Biografía</div>
                    <div class="card-body">
                        <p class="mb-0 text-muted small">{{ $volunteer->biography }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-header">Datos de contacto</div>
                    <div class="card-body">
                        @if($hasAccepted)
                            <ul class="list-unstyled mb-0">
                                <li>Teléfono: <span class="text-muted">{{ $volunteer->phone }}</span></li>
                                <li>Email: <span class="text-muted">{{ $volunteer->user->email }}</span></li>
                            </ul>
                        @else
                            <p class="mb-0">Debe aceptar al voluntario para ver sus datos de contacto</p>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Redes sociales</div>
                    <div class="card-body">
                        <!-- Redes -->
                        @if ($volunteer->linkedin || $volunteer->facebook || $volunteer->instagram)
                            <ul class="list-unstyled mb-0">
                                @if ($volunteer->linkedin)
                                    <li>
                                        <a href="{{ $volunteer->linkedin }}"
                                           target="_blank">
                                            <i class="bi bi-linkedin fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->linkedin }}
                                        </a>
                                    </li>
                                @endif
                                @if ($volunteer->facebook)
                                    <li>
                                        <a href="{{ $volunteer->facebook }}"
                                           target="_blank">
                                            <i class="bi bi-facebook fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->facebook }}
                                        </a>
                                    </li>
                                @endif
                                @if ($volunteer->instagram)
                                    <li>
                                        <a href="{{ $volunteer->instagram }}"
                                           target="_blank">
                                            <i class="bi bi-instagram fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->instagram }}
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
                    <div class="card-header">Proyectos donde tienes aceptado este voluntario</div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Su solicitud de aplicación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
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
                                            @if($project->volunteers->first()->pivot->status == 'aceptado')
                                            <span class="badge text-capitalize text-body">{{ $project->volunteers->first()->pivot->status }}</span>
                                            @else
                                            <span class="badge text-capitalize {{ $project->volunteers->first()->pivot->status == 'pendiente' ? 'bg-warning text-bg-warning' : 'bg-danger' }}">
                                                {{ $project->volunteers->first()->pivot->status }}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('host.my-projects.show', $project->id) }}" class="btn btn-azul btn-sm @if ($project->enabled === 0) disabled @endif">Ver</a>
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
