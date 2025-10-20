@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-5">Mis <span>Proyectos</span></h1>
            <!--Crear proyecto-->
            <form method="GET"
                action="{{ route('my-projects.create') }}">
                @csrf
                <button class="btn btn-primary mb-4" type="submit">Crear Proyecto</button>
            </form>
        </div>

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No tienes proyectos creados aún.</p>
            @endif

            <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-3 col-12">
                    <div class="card project-item">
                        <img src="{{ asset('storage/' . $project->image) }}" width="330" height="200" alt="{{ $project->title }}"
                            class="card-img-top d-block m-auto object-fit-cover w-100 h-auto">
                        <div class="card-body">
                            <h2 class="h4 text-primary">{{ $project->title }}</h2>
                            <p class="mb-0"><span class="small text-muted">Tipo: </span>{{ $project->projectType->name }}</p>
                            <p><span class="small text-muted">Anfitrión: </span>{{ $project->host->name }}</p>
                            @if ($project->conditions->isNotEmpty())
                                <p class="mb-0">Condiciones</p>
                                <ul>
                                    @foreach ($project->conditions as $condition)
                                        <li>{{ $condition->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="mb-0">Descripción:</p>
                            <p class="mb-0">{{ $project->host->description }}</p>
                        </div>
                        <!--Btnes de editar y delete-->
                    </div>
                </div>
            @endforeach
            </div>
    </section>
@endsection
