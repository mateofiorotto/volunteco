@extends('layouts.app')

@section('content')
    <section class="container text-break">
        <h2>Proyectos</h2>
        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @endif

            <div class="row justify-content-center align-items-center gap-5">
                @foreach ($projects as $project)
                    <div style="width: 20rem;" class="card col-lg-4 col-md-6 col-12 project-item pt-4 pb-4">
                        <a href="{{ route('project', $project->id) }}">
                            <img style="width: 200px; height: 200px;" src="{{ asset('storage/' . $project->image) }}" alt="Imagen del proyecto" class="card-img-top d-block m-auto">
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
                        </a>
                    </div>
                @endforeach
            </div>
    </section>
@endsection
