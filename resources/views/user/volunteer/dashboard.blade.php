@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Dashboard</h1>
        </div>

        <!-- Últimos Proyectos Aplicados -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex flex-fill justify-content-between">
                <h2 class="h4 mb-0">Mis <span class="fw-light">últimos proyectos</span></h2>
                </div>
                <a href="{{ route('volunteer.projects.applied') }}"
                   class="btn btn-sm btn-primary">
                    Ver todos
                </a>
            </div>


            @if ($appliedProjects->isEmpty())
                <div class="alert alert-info d-inline-block">
                    <i class="bi bi-info-circle me-2"></i>
                    Aún no has aplicado a ningún proyecto.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($appliedProjects as $project)
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 {{ $project->enabled === 0 ? 'border-danger' : '' }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <h3 class="card-title mb-0 h4">
                                            {{ $project->title }}
                                        </h3>
                                        <span
                                              class="badge p-2 text-capitalize
                                            @if ($project->pivot->status === 'aceptado') bg-primary
                                            @elseif($project->pivot->status === 'rechazado') bg-danger
                                            @else bg-warning text-dark @endif">
                                            {{ $project->pivot->status }}
                                        </span>
                                    </div>
                                    <p class="small text-muted">{{$project->host->name}}</p>

                                    <p class="card-text small">
                                        {{ Str::limit($project->description, 100) }}
                                    </p>

                                    @if ($project->pivot->status !== 'aceptado')
                                        @if ($project->pivot->status === 'pendiente')
                                        <p class="mb-3 small">
                                            <i class="bi bi-circle-fill text-warning me-1"></i>
                                            Aplicado: <span>{{ \Carbon\Carbon::parse($project->pivot->applied_at)->format('d/m/Y') }}</span>
                                        </p>
                                        @else
                                        <p class="mb-3 small">
                                            <i class="bi bi-dash-circle-fill text-danger me-1"></i>
                                            Aplicado: <span>{{ \Carbon\Carbon::parse($project->pivot->applied_at)->format('d/m/Y') }}</span>
                                        </p>
                                        @endif
                                    @else
                                        <p class="mb-3 small">
                                            <i class="bi bi-check-circle-fill text-primary me-1"></i>
                                            Aceptado: <span class="text-muted">{{ \Carbon\Carbon::parse($project->pivot->accepted_at)->format('d/m/Y') }}</span>
                                        </p>
                                    @endif

                                    @if ($project->enabled === 0)
                                        <p class="text-muted small">Este proyecto se encuentra <span class="text-danger fw-semibold">deshabilitado</span></p>
                                    @endif

                                    @if ($project->enabled === 1)
                                    <a href="{{ route('project', $project->id) }}"
                                       class="btn btn-sm btn-azul">
                                        Ver detalles
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Últimos Proyectos Publicados -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Proyectos <span class="fw-light">nuevos</span></h2>
                <a href="{{ route('projects') }}"
                   class="btn btn-sm btn-primary">
                    Ver todos
                </a>
            </div>

            @if ($latestProjects->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    No hay proyectos publicados en este momento.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($latestProjects as $project)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                        class="card-img-top card-projects-dashboard"
                                        alt="{{ $project->title }}">

                                <div class="card-body">
                                    <h3 class="card-title h4">{{ $project->title }}</h3>
                                    @if ($project->location)
                                        <div class="small mb-3">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $project->location->name }} - {{ $project->location->province->name }}
                                        </div>
                                    @endif

                                    <p class="card-text small mb-3">
                                        {{ Str::limit($project->description, 120) }}
                                    </p>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('project', $project->id) }}"
                                           class="btn btn-sm btn-azul">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent text-muted small">
                                    <i class="bi bi-clock me-1"></i>
                                    Publicado {{ $project->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
