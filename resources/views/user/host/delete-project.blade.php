@extends('layouts.app')

@section('content')

    <section class="container py-5">
        <div class="d-flex flex-column align-items-center mb-5">
            <h2 class="title-h1 h3 mb-4 text-center">Eliminar <span>Proyecto</span></h2>
            <p class="text-center">¿Estás seguro de que deseas eliminar el proyecto "<strong>{{ $project->title }}</strong>"? Esta acción no se puede deshacer.</p>
        </div>

        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('my-projects.destroy', $project->id) }}">
                @csrf
                @method('DELETE')
                <div class="d-flex gap-3 justify-content-center">
                    <button type="submit" class="btn btn-danger">Eliminar Proyecto</button>
                    <a href="{{ route('my-projects.index') }}" class="text-light btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </section>

@endsection