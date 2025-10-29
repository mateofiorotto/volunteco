@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Mis <span>Proyectos</span></h1>
            </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Proyectos Aceptados --}}
        @php
            $acceptedProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'aceptado');
        @endphp
        @if ($acceptedProjects->isNotEmpty())
            <h2>Proyectos en los que participo</h2>
            <div class="row mb-4">
                <x-project-card :projects="$acceptedProjects" />
            </div>
        @endif

        {{-- Proyectos Pendientes --}}
        @php
            $pendingProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'pendiente');
        @endphp
        @if ($pendingProjects->isNotEmpty())
            <h2>Proyectos a los que apliqué</h2>
            <div class="row mb-4">
                <x-project-card :projects="$pendingProjects" />
            </div>
        @endif

        {{-- Proyectos Rechazados --}}
        @php
            $rejectedProjects = $appliedProjects->filter(fn($p) => $p->pivot->status === 'rechazado');
        @endphp
        @if ($rejectedProjects->isNotEmpty())
            <h2>Proyectos en los que me rechazaron</h2>
            <div class="row mb-4">
                <x-project-card :projects="$rejectedProjects" />
            </div>
        @endif

        {{-- Si no hay proyectos --}}
        @if ($appliedProjects->isEmpty())
            <div class="alert alert-info">
                <p>No has aplicado a ningún proyecto aún</p>
            </div>
        @endif
        </div>
    </section>
@endsection
