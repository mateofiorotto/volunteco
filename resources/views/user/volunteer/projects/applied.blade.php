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
            @if ($acceptedProjects->isNotEmpty())
                <div class="mb-5">
                    <h2 class="h4 mb-3">Proyectos en los que participo</h2>
                    <x-project-grid :projects="$acceptedProjects" />
                    
                    @if ($acceptedProjects->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $acceptedProjects->links() }}
                        </div>
                    @endif
                </div>
            @endif

            {{-- Proyectos Pendientes --}}
            @if ($pendingProjects->isNotEmpty())
                <div class="mb-5">
                    <h2 class="h4 mb-3">Proyectos a los que apliqué</h2>
                    <x-project-grid :projects="$pendingProjects" />
                    
                    @if ($pendingProjects->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $pendingProjects->links() }}
                        </div>
                    @endif
                </div>
            @endif

            {{-- Proyectos Rechazados --}}
            @if ($rejectedProjects->isNotEmpty())
                <div class="mb-5">
                    <h2 class="h4 mb-3">Proyectos en los que me rechazaron</h2>
                    <x-project-grid :projects="$rejectedProjects" />
                    
                    @if ($rejectedProjects->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $rejectedProjects->links() }}
                        </div>
                    @endif
                </div>
            @endif

            {{-- Si no hay proyectos --}}
            @if ($acceptedProjects->isEmpty() && $pendingProjects->isEmpty() && $rejectedProjects->isEmpty())
                <div class="alert alert-info">
                    <p class="mb-0">No has aplicado a ningún proyecto aún</p>
                </div>
            @endif
        </div>
    </section>
@endsection