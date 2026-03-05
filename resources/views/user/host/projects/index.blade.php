@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Mis <span>proyectos</span></h1>
            <!--Crear proyecto-->
            <a href="{{ route('host.my-projects.create') }}"
               class="btn btn-primary">Crear proyecto</a>
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
            <div class="table-responsive">
                <div class="d-flex justify-content-end py-2 gap-2 flex-wrap">
                    <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
                    <div class="small"><i class="bi bi-circle-fill dot-desactivado"></i> Desactivado</div>
                </div>
                <table class="table responsive-table">
                    <thead>
                        <tr>
                            <th scope="col" >Imagen</th>
                            <th scope="col">Título</th>
                            <th scope="col">Fechas</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col">Voluntarios</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="{{ $project->enabled !== 1 ? 'table-danger' : '' }} align-middle">
                                <td>
                                    <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                         alt="Imagen del proyecto {{ $project->title }}"
                                         class="object-fit-cover"
                                         width="80"
                                         height="auto">
                                </td>
                                <td>{{ $project->title }}</td>
                                <td>
                                    <div>Inicia: <span class="small text-muted">{{ $project->start_date->format('d/m/Y') }}</span></div>
                                    <div>Finaliza: <span class="small text-muted">{{ $project->end_date->format('d/m/Y') }}</span></div>
                                </td>
                                <td class="text-center">
                                    <div class="dot-{{$project->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                </td>
                                <td>
                                    @if ($project->volunteers->isEmpty())
                                        <p class="mb-0 small">No hay voluntarios asociados a este proyecto.</p>
                                    @else
                                        <p class="mb-0 small">Hay {{ $project->volunteers->count() }} voluntarios</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('host.my-projects.show', $project->id) }}"
                                       class="btn btn-sm btn-azul"
                                       title="ver">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                @if ($projects->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $projects->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
