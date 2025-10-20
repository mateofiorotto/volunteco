@extends('layouts.app')

@section('content')
    <section class="container pt-5 pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                {{ session('success') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                {{ session('error') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Proyectos Aceptados --}}
        @php
            $acceptedProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'aceptado');
        @endphp
        @if ($acceptedProjects->isNotEmpty())
            <h3>Proyectos en los que participo</h3>
            <div class="row mb-4">
                @foreach ($acceptedProjects as $project)
                    @include('components.project-card', ['project' => $project])
                @endforeach
            </div>
        @endif

        {{-- Proyectos Pendientes --}}
        @php
            $pendingProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'pendiente');
        @endphp
        @if ($pendingProjects->isNotEmpty())
            <h3>Proyectos a los que apliqué</h3>
            <div class="row mb-4">
                @foreach ($pendingProjects as $project)
                    @include('components.project-card', ['project' => $project])
                @endforeach
            </div>
        @endif

        {{-- Proyectos Rechazados --}}
        @php
            $rejectedProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'rechazado');
        @endphp
        @if ($rejectedProjects->isNotEmpty())
            <h3>Proyectos en los que me rechazaron</h3>
            <div class="row mb-4">
                @foreach ($rejectedProjects as $project)
                    @include('components.project-card', ['project' => $project])
                @endforeach
            </div>
        @endif

        {{-- Si no hay proyectos --}}
        @if ($appliedProjects->isEmpty())
            <div class="alert alert-info">
                <p>No has aplicado a ningún proyecto aún</p>
            </div>
        @endif
    </section>
@endsection
