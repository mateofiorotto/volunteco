@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="projects-hero bg-primary">
        <div class="container">
            <div class="projects-hero-content text-center">
                <h1>Proyectos de <span class="fw-light">voluntariado</span></h1>
                <p>Encontrá un proyecto que te guste y formá parte del cambio</p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Filtros -->
            <div class="filters-section d-none">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="filter-title">Buscar proyectos</label>
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
                            <input type="text"
                                   class="form-control"
                                   placeholder="Busca por nombre, ubicación o tipo de proyecto...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="filter-title">Tipo de proyecto</label>
                        <select class="form-select">
                            <option selected>Todos los tipos</option>
                            <option>Reforestación</option>
                            <option>Fauna Marina</option>
                            <option>Agricultura Sostenible</option>
                            <option>Conservación</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="filter-title">Ubicación</label>
                        <select class="form-select">
                            <option selected>Todas las ubicaciones</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>
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
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        <h3 class="ff-nunito">No hay proyectos disponibles</h3>
                        <p>Actualmente no hay proyectos publicados. Te invitamos a volver pronto para descubrir nuevas
                            oportunidades de voluntariado.</p>
                        <a href="{{ route('home') }}"
                           class="btn btn-primary">Volver al Inicio</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card project-card">
                                    <div>
                                        <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="414" height="232">
                                        <div class="project-badge-overlay">
                                            <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5">{{ $project->title }}</h3>

                                        <p class="card-text mb-3 small text-muted">
                                            {{ Str::limit($project->description, 100) }}
                                        </p>

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
                                               class="btn btn-azul w-100">
                                                Ver detalles
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
