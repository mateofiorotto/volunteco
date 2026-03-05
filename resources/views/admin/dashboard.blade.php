@extends('layouts.admin')

@push('styles')
<style>
@media (max-width: 992px) {
    .responsive-table {
        --table-header-width: 84px;
    }
    .project-table .responsive-table {
        --table-header-width: 106px;
    }
}
</style>
@endpush

@section('content')
    <section class="container py-md-5 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="title-h1 h3 mb-0">Panel de <span>administración</span></h1>
        </div>

        <div class="d-flex justify-content-end py-2 gap-2">
            <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
            <div class="small"><i class="bi bi-circle-fill dot-pendiente"></i> Pendiente</div>
            <div class="small"><i class="bi bi-circle-fill dot-inactivo"></i> Inactivo</div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-5">
                <div class="card border-primary">
                    <div class="card-header text-bg-primary">
                        <h2 class="h5 mb-0">Últimos anfitriones <span class="small fw-light">(Total:
                                {{ $hostCount }})</span></h2>
                    </div>
                    <div class="card-body">
                        @if ($hostsLast->isEmpty())
                            <p class="mb-0">No hay anfitriones registrados.</p>
                        @else
                            <x-admin.dashboard-table :list="$hostsLast" routeLink="admin.hosts.profile"/>

                            <div class="text-end">
                                <a href="{{route('admin.hosts.index')}}" class="btn btn-primary">Ver todos</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-5">
                <div class="card border-warning">
                    <div class="card-header text-bg-warning">
                        <h2 class="h5 mb-0">Últimos voluntarios <span class="small fw-light">(Total:
                                {{ $volunteerCount }})</span></h2>
                    </div>
                    <div class="card-body">
                        @if ($volunteersLast->isEmpty())
                            <p>No hay voluntarios registrados.</p>
                        @else
                            <x-admin.dashboard-table :list="$volunteersLast" routeLink="admin.volunteer.profile"/>

                            <div class="text-end">
                                <a href="{{route('admin.volunteers.index')}}" class="btn btn-warning">Ver todos</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end py-2 gap-2">
            <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
            <div class="small"><i class="bi bi-circle-fill dot-desactivado"></i> Desactivado</div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card border-azul">
                    <div class="card-header text-bg-azul">
                        <h2 class="h5 mb-0">Últimos proyectos <span class="small fw-light">(Total:
                                {{ $projectsCount }})</span></h2>
                    </div>
                    <div class="card-body">
                        @if ($projectsLast->isEmpty())
                            <p>No hay proyectos.</p>
                        @else
                            <div class="table-responsive project-table">
                                <table class="table responsive-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Título</th>
                                            <th scope="col">Lugar</th>
                                            <th scope="col">Anfitrión</th>
                                            <th scope="col" class="text-center">Estado</th>
                                            <th scope="col" class="text-center">Voluntarios</th>
                                            <th scope="col"
                                                class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projectsLast as $project)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div><span class="d-lg-none"># </span>{{ $project->id }}</div>
                                                        <div class="d-lg-none dot-{{$project->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                                    </div>

                                                </th>
                                                <td data-label="Título:">{{ $project->title }}</td>
                                                <td data-label="Lugar:">{{ $project->location->name }} - {{$project->location->province->name}}</td>
                                                <td data-label="Anfitrión:">{{ $project->host->name }}</td>
                                                <td class="text-center hidden-mb">
                                                    <div class="dot-{{$project->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                                </td>
                                                <td data-label="Voluntarios:" class="text-xl-center">{{ $project->volunteers->count() }}</td>
                                                <td class="text-xl-center"><a
                                                    href="{{ route('admin.projects.show', $project->id) }}"
                                                    class="btn btn-sm btn-azul"
                                                    title="ver">Ver</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end">
                                <a href="{{route('admin.projects.index')}}" class="btn btn-azul">Ver todos</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
