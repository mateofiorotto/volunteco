@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-5">Mis <span>Proyectos</span></h1>
            <!--Crear proyecto-->
            <form method="GET"
                  action="{{ route('my-projects.create') }}">
                @csrf
                <button class="btn btn-primary mb-4"
                        type="submit">Crear Proyecto</button>
            </form>
        </div>

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @endif

            <div class="row justify-content-center">
                @foreach ($projects as $project)
                    @include('components.project-card', ['project' => $project])
                @endforeach
            </div>
    </section>
@endsection
