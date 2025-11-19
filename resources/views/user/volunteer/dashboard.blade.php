@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Dashboard del <span>Voluntario</span></h1>
        </div>

        <!-- Últimos Proyectos Aplicados -->
        <div class="mb-5">
            <h2 class="h4 mb-4">Mis Últimas Aplicaciones</h2>

            @if ($appliedProjects->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Aún no has aplicado a ningún proyecto.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($appliedProjects as $project)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm {{ $project->enabled === 0 ? 'border-danger' : '' }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h3 class="card-title mb-0">
                                            {{ $project->title }}
                                            @if ($project->enabled === 0)
                                                <span class="badge bg-danger d-block mt-2">Deshabilitado</span>
                                            @endif
                                        </h3>
                                        <span
                                              class="badge 
                                            @if ($project->pivot->status === 'aceptado') bg-primary
                                            @elseif($project->pivot->status === 'rechazado') bg-danger
                                            @else bg-warning text-dark @endif">
                                            {{ ucfirst($project->pivot->status) }}
                                        </span>
                                    </div>

                                    <p class="card-text text-muted small mb-3">
                                        {{ Str::limit($project->description, 100) }}
                                    </p>

                                    <div class="text-muted small mb-2">
                                        <i class="bi bi-calendar me-1"></i>
                                        Aplicado: {{ \Carbon\Carbon::parse($project->pivot->applied_at)->format('d/m/Y') }}
                                    </div>

                                    @if ($project->pivot->accepted_at)
                                        <div class="text-success small mb-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Aceptado:
                                            {{ \Carbon\Carbon::parse($project->pivot->accepted_at)->format('d/m/Y') }}
                                        </div>
                                    @endif

                                    <a href="{{ route('project', $project->id) }}"
                                       class="btn btn-sm btn-azul mt-2 {{ $project->enabled === 0 ? 'disabled' : '' }}">
                                        Ver Detalles
                                    </a>
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
                <h2 class="h4 mb-0">Últimos Proyectos Publicados</h2>
                <a href="{{ route('projects') }}"
                   class="btn btn-sm btn-primary">
                    Ver Todos
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
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}"
                                         class="card-img-top"
                                         alt="{{ $project->title }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif

                                <div class="card-body">
                                    <h3 class="card-title">{{ $project->title }}</h3>

                                    <p class="card-text text-muted small mb-3">
                                        {{ Str::limit($project->description, 120) }}
                                    </p>

                                    @if ($project->host)
                                        <div class="text-muted small mb-2">
                                            <i class="bi bi-building me-1"></i>
                                            {{ $project->host->name }}
                                        </div>
                                    @endif

                                    @if ($project->location)
                                        <div class="text-muted small mb-3">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $project->location->name }} - {{ $project->location->province->name }}
                                        </div>
                                    @endif

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('project', $project->id) }}"
                                           class="btn btn-sm btn-azul flex-grow-1">
                                            Ver Detalles
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
