@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="title-h1 h3 mb-5">Mis <span>Proyectos</span></h2>
            <!--Crear proyecto-->
            <a href="{{ route('hosts.my-projects.create') }}" class="btn btn-primary mb-4">Crear Proyecto</a>
        </div>

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @endif

            <div class="row justify-content-center">
                <x-project-card :projects="$projects" />
            </div>
    </section>
@endsection
