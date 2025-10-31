@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <h2>Proyectos</h2>
            <div class="projects-list">
                @if ($projects->isEmpty())
                    <p>No hay proyectos publicados actualmente.</p>
                @endif

                <x-project-grid :projects="$projects" />
            </div>
        </div>
    </section>
@endsection
