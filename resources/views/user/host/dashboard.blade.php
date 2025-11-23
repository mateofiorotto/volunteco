@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="dashboard-header">
        <div class="container">
            <h1 class="ff-nunito">¡Bienvenido, {{ $host->name }}!</h1>
            <p>Gestioná tus proyectos y conectá con voluntarios de todo el mundo</p>
        </div>
    </div>

    <section class="container pb-5">
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </div>
                    <div class="stats-number">{{ $host->projects->count() }}</div>
                    <div class="stats-label">Proyectos Publicados</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div class="stats-number">{{ $host->projects->sum(function ($p) {return $p->volunteers->count();}) }}
                    </div>
                    <div class="stats-label">Total de voluntarios</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="stats-number">{{ $host->projects->where('enabled', 1)->count() }}</div>
                    <div class="stats-label">Proyectos Activos</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Proyectos -->
            <div class="col-lg-9">
                <h2 class="section-title-dashboard ff-nunito mb-4">
                    Mis <span>Proyectos</span>
                </h2>

                @if ($host->projects->isEmpty())
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                        </svg>
                        <h3 class="ff-nunito">No tenés proyectos publicados</h3>
                        <p class="text-muted">Creá tu primer proyecto y comenzá a recibir voluntarios de todo el mundo</p>
                        <a href="{{ route('host.my-projects.create') }}"
                           class="btn btn-primary btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor"
                                 width="20"
                                 height="20"
                                 style="display: inline; margin-right: 8px;">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Publicar Primer Proyecto
                        </a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($host->projects as $project)
                            <div class="col-md-6">
                                <div class="card project-card-dashboard {{ $project->enabled === 0 ? 'disabled' : '' }}">
                                    <div style="position: relative; overflow: hidden;">
                                        <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                             class="card-img-top"
                                             alt="{{ $project->title }}">
                                        @if ($project->enabled != 1)
                                            <div style="position: absolute; top: 15px; right: 15px;">
                                                <span class="badge bg-danger">Desactivado</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5 ff-nunito mb-3">
                                            {{ $project->title }}
                                        </h3>

                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($project->description, 80) }}
                                        </p>

                                        @if ($project->enabled === 0)
                                            <div class="alert alert-danger py-2 px-3 mb-3"
                                                 style="font-size: 0.85rem;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="2"
                                                     stroke="currentColor"
                                                     width="16"
                                                     height="16"
                                                     style="display: inline; margin-right: 5px;">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                </svg>
                                                Proyecto deshabilitado
                                            </div>
                                        @endif

                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mb-3 text-muted small">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     width="16"
                                                     height="16"
                                                     style="display: inline; margin-right: 5px;">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>
                                                {{ $project->volunteers->count() }} voluntarios
                                            </div>
                                            <a href="{{ route('host.my-projects.show', $project->id) }}"
                                               class="btn btn-azul w-100">
                                                Ver Detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                @if ($host->projects->isNotEmpty())
                    <div class="sidebar-card text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             width="50"
                             height="50"
                             class="mx-auto mb-3"
                             style="color: var(--bs-primary);">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <p class="fw-semibold mb-3">¿Tenés un proyecto nuevo?</p>
                        <a href="{{ route('host.my-projects.create') }}"
                           class="btn btn-primary w-100">Crear Proyecto</a>
                    </div>
                @endif

                <div class="notification-card text-break {{ $lastAppliedVolunteer ? 'has-applicant' : '' }}">
                    @if ($lastAppliedVolunteer)
                        <div class="notification-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </div>
                        <h3 class="text-primary fw-bold mb-2">¡Nueva Postulación!</h3>
                        <p class="mb-2">
                            <strong>{{ $lastAppliedVolunteer['volunteer']->name }}</strong> se postuló a tu proyecto:
                        </p>
                        <p class="mb-2">
                            <strong class="text-primary">{{ $lastAppliedVolunteer['project']->title }}</strong>
                        </p>
                        <p class="small text-muted mb-3">
                            {{ $lastAppliedVolunteer['applied_at']->diffForHumans() }}
                        </p>
                        <a href="{{ route('host.my-projects.show', $lastAppliedVolunteer['project']->id) }}"
                           class="btn btn-primary w-100">
                            Ver Postulación
                        </a>
                    @else
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 width="50"
                                 height="50"
                                 class="mx-auto mb-3"
                                 style="color: var(--bs-gray-500);">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <p class="text-muted mb-0">No hay postulaciones pendientes</p>
                            <small class="text-muted">Te notificaremos cuando alguien se postule</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
