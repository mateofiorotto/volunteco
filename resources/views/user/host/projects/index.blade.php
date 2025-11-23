@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="ff-nunito">Mis Proyectos</h1>
                    <p>Administrá y gestioná todos tus proyectos de voluntariado</p>
                </div>
                <a href="{{ route('host.my-projects.create') }}"
                   class="btn btn-light">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         width="18"
                         height="18"
                         style="display: inline; margin-right: 8px;">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Crear Proyecto
                </a>
            </div>
        </div>
    </div>

    <section class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4"
                 role="alert">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         width="24"
                         height="24"
                         style="margin-right: 12px;">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div>
                        <strong>¡Perfecto!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4"
                 role="alert">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         width="24"
                         height="24"
                         style="margin-right: 12px;">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        @if ($projects->isEmpty())
            <div class="table-card">
                <div class="empty-state-table">
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
                    <p>Creá tu primer proyecto y comenzá a recibir voluntarios de todo el mundo</p>
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
                        Crear Mi Primer Proyecto
                    </a>
                </div>
            </div>
        @else
            <div class="table-card">
                <div class="table-header">
                    <h2 class="table-title ff-nunito">Todos Mis Proyectos ({{ $projects->total() }})</h2>
                </div>

                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th scope="col">Proyecto</th>
                                <th scope="col">Fechas</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Voluntarios</th>
                                <th scope="col"
                                    class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr class="{{ $project->enabled != 1 ? 'disabled' : '' }}">
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                                 alt="{{ $project->title }}"
                                                 class="project-thumb">
                                            <div>
                                                <div class="project-title-cell">{{ $project->title }}</div>
                                                <small class="text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5"
                                                         stroke="currentColor"
                                                         width="14"
                                                         height="14"
                                                         style="display: inline; margin-right: 3px;">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                    </svg>
                                                    {{ $project->location->name ?? 'Sin ubicación' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <div class="date-row">
                                                <span class="date-label">Inicia:</span>
                                                <span
                                                      class="date-value">{{ $project->start_date->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="date-row">
                                                <span class="date-label">Finaliza:</span>
                                                <span class="date-value">{{ $project->end_date->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($project->enabled)
                                            <span>
                                                <span class="status-dot"></span>
                                                Activo
                                            </span>
                                        @else
                                            <span>
                                                <span class="status-dot"></span>
                                                Deshabilitado
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->volunteers->isEmpty())
                                            <span class="text-muted small">Sin voluntarios</span>
                                        @else
                                            <div class="volunteers-info">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     width="20"
                                                     height="20"
                                                     class="volunteers-icon">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>
                                                <span class="volunteers-count">{{ $project->volunteers->count() }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('host.my-projects.show', $project->id) }}"
                                           class="btn btn-sm btn-azul">
                                            Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($projects->hasPages())
                    <div class="pagination">
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        @endif
    </section>
@endsection
