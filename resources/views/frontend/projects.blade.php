@extends('layouts.app')

@php
    $projectTypesId = $projects->pluck('projectType')->unique('id');
@endphp

@push('styles')
<style>
@foreach($projectTypesId as $type)
    .badge-{{ $type->key }} {
        border: 2px solid {{ $type->color }};
        color: {{ $type->color }}!important;
        background-color: #ffffff;
    }
@endforeach
</style>
@endpush


@section('content')
    <!-- Hero Section -->
    <section class="projects-hero bg-primary">
        <div class="container">
            <div class="projects-hero-content text-center">
                <h1>Proyectos de <span class="fw-light">voluntariado</span></h1>
                <p>Encontrá un proyecto que te guste y formá parte del cambio.</p>
            </div>
        </div>
    </section>

    <section class="py-md-5 py-3 bg-body-tertiary">
        <div class="container">
            <!-- Filtros -->
            <div class="filters-section">
                <form method="GET" action="{{ route('projects') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="search" class="filter-title">Buscar proyectos</label>
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="search-icon"
                                    width="20"
                                    height="20">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                                <input type="text" class="form-control" name="search" id="search" placeholder="Buscar por palabra clave..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="project_type_id" class="filter-title">Tipo de proyecto</label>
                            <select name="project_type_id" id="project_type_id" class="form-select">
                                <option value="">Todos los tipos</option>
                                @foreach ($projectTypes as $type)
                                    <option
                                        value="{{ $type->id }}"
                                        {{ request('project_type_id') == $type->id ? 'selected' : '' }}
                                    >
                                        {{ $type->name }} ({{ $type->projects_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="province_id" class="filter-title">Ubicación</label>
                            <select name="province_id" id="province_id" class="form-select">
                                <option value="">Todas las provincias</option>
                                @foreach ($provinces as $province)
                                    <option
                                        value="{{ $province->id }}"
                                        {{ request('province_id') == $province->id ? 'selected' : '' }}
                                    >
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                            @php
                                $hasFilters =
                                    request()->filled('search') ||
                                    request()->filled('province_id') ||
                                    request()->filled('project_type_id');
                            @endphp
                            <a href="{{ route('projects') }}" class="btn-clear btn btn-outline-primary {{ !$hasFilters ? 'disabled' : '' }}">Limpiar búsqueda</a>
                        </div>
                    </div>
                </form>

            </div>

            <!-- Contador de proyectos -->
            @if (!$projects->isEmpty())
                <div class="projects-count">
                    Mostrando <strong>{{ $projects->count() }}</strong> de <strong>{{ $projects->total() }}</strong>
                    proyectos
                </div>
            @endif

            <!-- Lista de proyectos -->
            <div class="projects-list">
                @if ($projects->isEmpty())
                    <div class="empty-state">
                        <p class="ff-nunito h3">No hay proyectos disponibles</p>
                        <p>Actualmente no hay proyectos publicados. Te invitamos a volver pronto para descubrir nuevas oportunidades de voluntariado.</p>
                        <a href="{{ route('home') }}"
                           class="btn btn-primary">Volver a la home</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card project-card">
                                    <div>
                                        <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="414" height="232">
                                        <div class="project-badge-overlay">
                                            <span class="badge badge-{{ $project->projectType->key }}">{{ $project->projectType->name }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h2 class="card-title h5">{{ $project->title }}</h2>

                                        <p class="card-text mb-3 small text-muted">{{ Str::limit($project->description, 100) }}</p>
                                            @php
                                            $authVolunteer = null;

                                            if(auth()->check() && auth()->user()->hasRole('volunteer')) {
                                                $authVolunteer = $project->volunteers
                                                    ->firstWhere('user_id', auth()->id());
                                            }
                                            @endphp

                                            @if($authVolunteer)
                                                <div class="text-end d-flex justify-content-end align-items-center">
                                                    <div class="dot-{{$authVolunteer->pivot->status}} small me-2">
                                                        <i class="bi bi-circle-fill"></i>
                                                    </div>

                                                    <p class="text-capitalize small mb-0">
                                                        {{ $authVolunteer->pivot->status }}
                                                    </p>
                                                </div>
                                            @endif

                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mb-3 text-muted small">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     width="18"
                                                     height="18"
                                                     class="text-primary me-2">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                </svg>
                                                <span>{{ $project->location->province->name }}</span>
                                            </div>

                                            <a href="{{ route('project', $project->id) }}"
                                               class="btn btn-azul w-100 stretched-link">
                                                Ver más
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="2"
                                                     stroke="currentColor"
                                                     width="16"
                                                     height="16"
                                                     style="display: inline; margin-left: 5px;">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="mt-5 d-flex justify-content-center paginator">
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    @if (!$projects->isEmpty())
        @include('partials.banner-register')
    @endif
@endsection
