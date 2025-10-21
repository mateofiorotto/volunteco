@extends('layouts.app')

@section('content')
    <section class="container text-break">
        <h2>Proyectos</h2>
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
