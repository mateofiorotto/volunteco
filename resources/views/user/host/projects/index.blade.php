@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Mis <span>Proyectos</span></h1>
            <!--Crear proyecto-->
            <a href="{{ route('host.my-projects.create') }}"
               class="btn btn-primary">Crear Proyecto</a>
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                {{ session('error') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif


        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="fw-semibold">Imagen</th>
                            <th scope="col"
                                class="fw-semibold">Título</th>
                            <th scope="col"
                                class="fw-semibold">Fechas</th>
                            <th scope="col"
                                class="fw-semibold">Estado</th>
                            <th scope="col"
                                class="fw-semibold">Voluntarios</th>
                            <th scope="col"
                                class="fw-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="{{ $project->enabled != 1 ? 'table-danger' : '' }}">
                                <td>
                                    <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                         alt="Imagen del proyecto {{ $project->title }}"
                                         class="object-fit-cover"
                                         width="80"
                                         height="auto">
                                </td>
                                <td>{{ $project->title }}</td>
                                <td>
                                    <div>
                                        <span class="small text-muted">Inicia: </span>
                                        {{ $project->start_date->format('d/m/Y') }}
                                    </div>
                                    <div>
                                        <span class="small text-muted">Finaliza:
                                        </span>{{ $project->end_date->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    @if ($project->enabled != 1)
                                        <span class="badge bg-danger">Deshabilitado</span>
                                    @else
                                        <span class="badge bg-transparent text-body">Activo</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($project->volunteers->isEmpty())
                                        <p class="mb-0 small">No hay voluntarios asociados a este proyecto.</p>
                                    @else
                                        <p class="mb-0 small">Hay {{ $project->volunteers->count() }} voluntarios</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('host.my-projects.show', $project->id) }}"
                                       class="btn btn-sm btn-azul"
                                       title="ver">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($projects->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $projects->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
