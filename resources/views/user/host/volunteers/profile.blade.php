@extends('layouts.admin')

@push('styles')
<style>
@media (max-width: 992px) {
    .project-table .responsive-table {
        --table-header-width: 106px;
    }
}
</style>
@endpush

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
                        <div class="d-flex flex-column flex-md-row gap-md-5 gap-3 align-items-start">
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

                <div class="card mb-4">
                    <div class="card-header">Prestigio</div>
                    <div class="card-body">
                        <x-volunteer-reputation-card :volunteer="$volunteer" />
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-end py-2 gap-2 flex-wrap">
                    <div class="small"><i class="bi bi-circle-fill dot-aceptado"></i> Aceptado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-pendiente"></i> Pendiente</div>
                    <div class="small"><i class="bi bi-circle-fill dot-rechazado"></i> Rechazado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-completado"></i> Completado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-cancelado"></i> Cancelado</div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Proyectos donde tienes a este voluntario</div>
                    <div class="card-body p-0">
                        <div class="table-responsive project-table">
                        <table class="table responsive-table">
                            <thead>
                                <tr>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col" class="text-center">Solicitud de aplicación</th>
                                    <th scope="col">Evaluación</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr class="align-middle {{ $project->enabled === 0 ? 'table-danger' : '' }}">
                                        <td data-label="Título: ">
                                            {{ $project->title }}
                                            <div class="d-lg-none dot-{{$project->volunteers->first()->pivot->status}}"><i class="bi bi-circle-fill"></i></div>
                                        </td>
                                        <td data-label="Fecha: ">
                                            <div>Inicia: <span class="small text-muted">{{ $project->start_date->format('d/m/Y') }}</span></div>
                                            <div>Finaliza: <span class="small text-muted">{{ $project->end_date->format('d/m/Y') }}</span></div>
                                        </td>
                                        <td data-label="Lugar: ">{{ $project->location->name }} - {{ $project->location->province->name }}</td>
                                        <td class="text-center hidden-mb">
                                            <div class="dot-{{$project->volunteers->first()->pivot->status}}"><i class="bi bi-circle-fill"></i></div>
                                        </td>
                                        <td data-label="Evaluación: ">
                                            @if($project->evaluations->isNotEmpty())
                                                <p class="mb-0">Nivel: <span class="text-muted small">{{ $project->evaluations->first()->performance_label }} ({{ $project->evaluations->first()->average_score }})</span></p>
                                            @else
                                                <p class="mb-0">Voluntariado en curso</p>
                                            @endif
                                        </td>
                                        <td class="text-lg-center" >
                                            <a href="{{ route('host.my-projects.show', $project->id) }}" class="btn btn-azul btn-sm @if ($project->enabled === 0) disabled @endif">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
