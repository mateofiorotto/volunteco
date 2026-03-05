@extends('layouts.admin')

@push('styles')
<style>
@media (max-width: 992px) {
    .project-table .responsive-table {
        --table-header-width: 104px;
    }
}
</style>
@endpush

@section('content')
    <section>
        <div class="container py-md-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title-h1 h3">Listado de <span>proyectos</h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
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

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="d-flex justify-content-end py-2 gap-2">
                        <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
                        <div class="small"><i class="bi bi-circle-fill dot-desactivado"></i> Desactivado</div>
                    </div>

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
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div><span class="d-lg-none"># </span>{{ $project->id }}</div>
                                                <div class="d-lg-none dot-{{$project->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                            </div>
                                        </th>
                                        <td data-label="Título: ">{{ $project->title }}</td>
                                        <td data-label="Lugar:">{{ $project->location->name }} - {{$project->location->province->name}}</td>
                                        <td data-label="Anfitrión: ">{{ $project->host->name }}</td>
                                        <td class="text-center hidden-mb">
                                            <div class="dot-{{$project->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                        </td>
                                        <td data-label="Voluntarios: " class="text-lg-center">{{ $project->volunteers->count() }}</td>
                                        <td class="text-lg-center">
                                            <a href="{{ route('admin.projects.show', $project->id) }}"
                                            class="btn btn-sm btn-azul">Ver proyecto</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="text-center">No hay proyectos disponibles</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($projects->hasPages())
                        {{ $projects->links() }}
                    @endif
                </div>
            </div>


        </div>
    </section>
@endsection
