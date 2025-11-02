@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Mis <span>Proyectos</span></h1>
            <!--Crear proyecto-->
            <a href="{{ route('hosts.my-projects.create') }}" class="btn btn-primary">Crear Proyecto</a>
        </div>

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @endif

            <x-project-grid :projects="$projects" />
    </section>
@endsection
