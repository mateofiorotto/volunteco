@extends('layouts.admin')

@section('content')
<section>
    <div class="container py-5">
        <h1 class="title-h1 h3 mb-5">Listado de <span>Proyectos</span></h1>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Host</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $projects as $project)
                        <tr>
                            <th scope="row">{{$project->id}}</th>
                            <td>{{$project->title}}</td>
                            <td>{{$project->host->name}}</td>
                            <td>
                            @if (!$project->enabled)
                                <span class="text-uppercase fw-semibold badge">DESACTIVADO</span>
                            @else
                                <span class="text-uppercase fw-semibold badge bg-transparent text-body">ACTIVO</span>
                            @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-azul">Ver Proyecto</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
