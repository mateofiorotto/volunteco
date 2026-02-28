@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Mis <span>proyectos</span></h1>
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
                            <tr class="align-middle {{ $project->enabled === 0 ? 'table-danger' : '' }} {{$project->pivot->isCanceled() || $project->pivot->isCompleted() ? 'table-active' : ''}}">
                                <td>
                                    {{ $project->title }}
                                    @if ($project->enabled === 0)
                                        <span class="badge text-bg-danger">Deshabilitado</span>
                                    @endif
                                </td>
                                <td>
                                    <div>Inicia: <span class="small text-muted">{{ $project->start_date->format('d/m/Y') }}</span></div>
                                    <div>Finaliza: <span class="small text-muted">{{ $project->end_date->format('d/m/Y') }}</span></div>
                                </td>
                                <td>{{ $project->location->name }} - {{ $project->location->province->name }}</td>
                                <td>{{ $project->host->name }}</td>
                                <td>
                                    <span class="badge text-capitalize badge-{{ $project->pivot->status_class }}">{{ $project->pivot->status }}</span>
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
                <div class="alert alert-info d-inline-block">
                    <p class="mb-0">No has aplicado a ningún proyecto aún</p>
                </div>
            @endif
        </div>
    </section>
@endsection
