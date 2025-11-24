@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Mis <span>Proyectos</span></h1>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    {{ session('error') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($projects->isNotEmpty())
                <table class="table">
                    <caption><small>Lista de proyectos donde has aplicado</small></caption>
                    <thead>
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Lugar</th>
                            <th scope="col">Anfitrión</th>
                            <th scope="col">Solicitud de aplicación</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="align-middle {{ $project->enabled === 0 ? 'table-danger' : '' }}">
                                <td>
                                    {{ $project->title }}
                                    @if ($project->enabled === 0)
                                        <span class="badge text-bg-danger">Deshabilitado</span>
                                    @endif
                                </td>
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
                                <td>{{ $project->location->name }} - {{ $project->location->province->name }}</td>
                                <td>{{ $project->host->name }}</td>
                                <td>
                                    @if ($project->pivot->status !== 'aceptado')
                                        <span class="badge text-capitalize {{ $project->pivot->status == 'pendiente' ? 'bg-warning text-bg-warning' : 'bg-danger' }}">{{ $project->pivot->status }}</span>
                                    @else
                                        <span class="badge bg-primary text-capitalize">{{ $project->pivot->status }}</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('project', $project->id) }}"
                                       class="btn btn-azul btn-sm @if ($project->enabled === 0) disabled @endif">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $projects->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <p class="mb-0">No has aplicado a ningún proyecto aún</p>
                </div>
            @endif
        </div>
    </section>
@endsection
