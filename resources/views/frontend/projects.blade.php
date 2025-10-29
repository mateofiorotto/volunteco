@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <h2>Proyectos</h2>
            <div class="projects-list">
                @if ($projects->isEmpty())
                    <p>No hay proyectos publicados actualmente.</p>
                @endif

                <div class="row justify-content-center">
                    <x-project-card :projects="$projects" />
                </div>
            </div>
        </div>
    </section>
@endsection
