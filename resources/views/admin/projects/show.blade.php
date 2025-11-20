@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Detalle del <span>Proyecto</span></h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
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

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="d-flex g-0">
                                        <div class="avatar p-3">
                                            <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                                 alt="Imagen del proyecto {{ $project->title }}"
                                                 class="object-fit-cover rounded"
                                                 width="120"
                                                 height="120">
                                        </div>
                                        <div class="card-body flex-fill">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="small text-muted">Proyecto</div>
                                                @if (!$project->enabled)
                                                    <span class="badge text-bg-danger">
                                                        Deshabilitado
                                                    </span>
                                                @endif
                                            </div>
                                            <h2 class="card-title h3">{{ $project->title }}</h2>
                                            <div class="row gap-5">
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><span class="text-muted small">Anfitrión:
                                                            </span>{{ $project->host->name }}</li>
                                                        <li><span class="text-muted small">Email: </span><a
                                                               href="mailto:{{ $project->host->user->email }}"
                                                               target="_blank">{{ $project->host->user->email }}</a></li>
                                                        <li><span class="text-muted small">Tipo:
                                                            </span>{{ $project->projectType->name ?? 'Sin tipo' }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><span class="text-muted small">Inicio:
                                                            </span>{{ $project->start_date->format('d/m/Y') }}</li>
                                                        <li><span class="text-muted small">Fin:
                                                            </span>{{ $project->end_date->format('d/m/Y') }}</li>
                                                        <li><span class="text-muted small">Horas por día:
                                                            </span>{{ $project->work_hours_per_day }}</li>
                                                        <li><span class="text-muted small">Ubicación:
                                                            </span>{{ $project->location->name }} -
                                                            {{ $project->location->province->name }}</li>
                                                        <li><span class="text-muted small">Creado:
                                                            </span>{{ $project->created_at->format('d/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">Descripción del Proyecto</div>
                                    <div class="card-body">
                                        {{ $project->description }}
                                    </div>
                                </div>
                            </div>
                            @if ($project->conditions->count() > 0)
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-header">Condiciones y Requisitos</div>
                                        <div class="card-body">
                                            <ul class="mb-0">
                                                @foreach ($project->conditions as $condition)
                                                    <li>{{ $condition->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Acciones</div>
                        <div class="card-body">
                            @if($project->enabled)
                                <p class="text-muted d-block small">
                                    Si decide desactivar este proyecto se le enviará una notificación al anfitrión vía email.
                                </p>
                                <div class="text-end">
                                    <button type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#desactivarModal">
                                        Desactivar Proyecto
                                    </button>
                                </div>
                            @else
                                <p class="text-muted d-block small mb-0">
                                    El proyecto solo puede ser activado por el anfitrión que lo creó.
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Información del Anfitrión</div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">{{ $project->host->name }}</h6>
                            <ul class="list-unstyled small">
                                <li><i class="bi bi-envelope me-2"></i><a href="mailto:{{ $project->host->user->email }}" target="_blank"> {{ $project->host->user->email }}</a></li>
                                @if ($project->host->phone)
                                    <li><i class="bi bi-telephone me-2"></i>{{ $project->host->phone }}</li>
                                @endif
                                @if ($project->host->location)
                                    <li><i
                                           class="bi bi-geo-alt me-2"></i>{{ $project->host->location->name }} - {{ $project->host->location->province->name }}
                                    </li>
                                @endif
                            </ul>
                            <div class="text-end">
                                <a href="{{ route('admin.hosts.profile', $project->host->id) }}"
                                class="btn btn-outline-primary">
                                    Ver perfil del anfitrión
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">Voluntarios Postulados</div>
                    <ul class="list-group list-group-flush">
                        @if ($project->volunteers->count() > 0)
                            @foreach ($project->volunteers as $volunteer)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                                 alt="Avatar de {{ $volunteer->full_name }}"
                                                 class="rounded-circle me-2"
                                                 width="40"
                                                 height="40">
                                            {{ $volunteer->full_name }}
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <span class="text-muted small me-2">Estado: </span>
                                            <span
                                                  class="badge {{ $volunteer->pivot->status === 'aceptado' ? 'text-bg-success' : ($volunteer->pivot->status === 'rechazado' ? 'text-bg-danger' : 'text-bg-warning') }}">
                                                {{ ucfirst($volunteer->pivot->status) }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <span class="text-muted small">Aplicó: </span>
                                            {{ \Carbon\Carbon::parse($volunteer->pivot->applied_at)->format('d/m/Y') }}
                                        </div>
                                        <div class="col-12 col-md-3 text-center">
                                            <a href="{{ route('admin.volunteer.profile', $volunteer->id) }}"
                                               class="btn btn-sm btn-azul"
                                               title="Ver perfil del voluntario">
                                                Ver Perfil
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-12 text-center text-muted">
                                        No hay voluntarios postulados a este proyecto
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('modals')
    <div class="modal fade"
         id="desactivarModal"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5">Desactivar proyecto</h2>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea desactivar este proyecto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-primary"
                            data-bs-dismiss="modal">No</button>

                    <form method="POST"
                            id="withdrawBtn"
                            action="{{ route('admin.projects.delete', $project->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100"
                                type="submit">Sí, desactivar proyecto
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Cierro el modal manualmente cuando envio el form
        document.getElementById('withdrawBtn').addEventListener('submit', function() {
            const modalEl = document.getElementById('desactivarModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
        });
    </script>
@endsection
