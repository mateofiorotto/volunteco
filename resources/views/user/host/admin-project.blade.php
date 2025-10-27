@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Proyecto</h1>
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>

        <!-- Alerta de exito temporal -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Alerta de error temporal mas adelante cambiar por swal2 o algo mas lindo -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <div class="row mb-5">
            <!-- Detalles del proyecto -->
            <div class="col-md-8 col-12 mb-4">
                <div class="card">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="400" height="400">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $project->title }}</h3>

                        <p class="card-text">{{ $project->description }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Ubicación</h4>
                                        <p class="mb-0">{{ $project->location }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-clock fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Horas por día</h4>
                                        <p class="mb-0">{{ $project->work_hours_per_day }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Fecha de inicio</h4>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Fecha de finalización</h4>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($project->conditions->isNotEmpty())
                            <div class="mt-4">
                                <div class="d-flex gap-2 align-items-start mb-3">
                                    <i class="bi bi-clipboard2-check fs-5 text-primary"></i>
                                    <h4 class="h6 fw-semibold mb-0">Condiciones y Requisitos</h4>
                                </div>
                                <ul class="list-unstyled ms-4">
                                    @foreach ($project->conditions as $condition)
                                        <li class="mb-2 d-flex gap-2 align-items-start">
                                            <i class="bi bi-check2"></i>
                                            <span>{{ $condition->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Acciones</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="GET"
                                    action="{{ route('my-projects.edit', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-primary w-100 mb-3"
                                            type="submit">
                                        Editar
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="GET"
                                    action="{{ route('my-projects.delete', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-primary w-100 mb-3"
                                            type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <a href="#volunteers-list">
                                    <button class="btn btn-secondary text-light w-100 mb-3"
                                            type="submit">
                                        Ver Voluntarios que aplicaron
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="volunteers-list" class="row">
            <h3>Voluntarios</h3>

            {{-- Voluntarios ACEPTADOS --}}
            @if ($registeredVolunteers->where('pivot.status', 'aceptado')->isNotEmpty())
                <h4 class="mt-4 mb-3">Voluntarios Aceptados</h4>
                @foreach ($registeredVolunteers->where('pivot.status', 'aceptado') as $volunteer)
                    <div class="card mb-3 w-100 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                <p class="card-text text-muted mb-0">Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Voluntarios PENDIENTES --}}
            @if ($registeredVolunteers->where('pivot.status', 'pendiente')->isNotEmpty())
                <h4 class="mt-4 mb-3">Voluntarios Pendientes</h4>
                @foreach ($registeredVolunteers->where('pivot.status', 'pendiente') as $volunteer)
                    <div class="card mb-3 w-100 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                <p class="card-text mb-0">Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong></p>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-secondary text-light">Ver Perfil</a> <!-- Cuando esten implementados los perfiles por id -->
                                <form method="POST" action="{{ route('my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-primary">Rechazar</button>
                                </form>

                                <form method="POST" action="{{ route('my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Voluntarios RECHAZADOS --}}
            @if ($registeredVolunteers->where('pivot.status', 'rechazado')->isNotEmpty())
                <h4 class="mt-4 mb-3">Voluntarios Rechazados</h4>
                @foreach ($registeredVolunteers->where('pivot.status', 'rechazado') as $volunteer)
                    <div class="card mb-3 w-100 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                <p class="card-text text-muted mb-0">
                                    Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Si no hay ninguno --}}
            @if ($registeredVolunteers->isEmpty())
                <p>No hay voluntarios inscritos en este proyecto.</p>
            @endif
        </div>
    </section>
@endsection
