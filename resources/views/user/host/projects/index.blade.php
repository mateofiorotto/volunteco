@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Mis <span>Proyectos</span></h1>
            <!--Crear proyecto-->
            <a href="{{ route('host.my-projects.create') }}" class="btn btn-primary">Crear Proyecto</a>
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

        <div class="projects-list">
            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @else
                <x-project-grid :projects="$projects" />

                @if($projects->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $projects->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
