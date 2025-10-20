@extends('layouts.app')

@section('content')
    <section class="container text-break">
        <h2 class="mt-4 mb-4">Mis Proyectos</h2>
        <!--Crear proyecto-->
        <form method="GET"
              action="{{ route('my-projects.create') }}">
            @csrf
            <button class="btn btn-success mb-4"
                    type="submit">Crear Proyecto</button>
        </form>

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No tienes proyectos creados aún.</p>
            @endif

            <div class="row justify-content-center gap-5 align-items-center">
            @foreach ($projects as $project)
                <div style="width: 20rem;"
                     class="card col-lg-4 col-md-6 col-12 project-item pt-4 pb-4">
                        <img style="width: 200px; height: 200px;"
                             src="{{ asset('storage/' . $project->image) }}"
                             alt="Imagen del proyecto"
                             class="card-img-top d-block m-auto">
                        <h3 class="mt-4">{{ $project->title }}</h3>
                        <p>ℹ️ {{ $project->projectType->name }}</p>
                        <p>{{ $project->host->name }}</p>
                        @if ($project->conditions->isNotEmpty())
                            <ul>
                                @foreach ($project->conditions as $condition)
                                    <li>{{ $condition->description }}</li>
                                @endforeach
                            </ul>
                        @endif
                            <!--Btnes de editar y delete-->
                </div>
            @endforeach
            </div>
    </section>
@endsection
