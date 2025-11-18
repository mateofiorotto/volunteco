@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <h1 class="title-h1 h3 mb-5">Listado de <span>Proyectos</span></h1>


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
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Anfitrión</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->id }}</th>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->host->name }}</td>
                                    <td>
                                        @if (!$project->enabled)
                                            <span class="text-uppercase fw-semibold badge text-bg-danger">No visible</span>
                                        @else
                                            <span class="text-uppercase fw-semibold badge bg-transparent text-body">Visible</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-sm btn-azul">Ver Proyecto</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay proyectos disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if($projects->hasPages())
                        {{ $projects->links() }}
                    @endif
                </div>
            </div>


        </div>
    </section>
@endsection
