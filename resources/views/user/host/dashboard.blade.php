@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Dashboard</h1>
        </div>

        <!-- Últimos Proyectos Aplicados -->
        <div class="mb-5">
            <h2 class="h4 mb-4">Mis <span class="fw-light">Últimas Proyectos</span></h2>

            <div class="row">
                <div class="col-md-9 pe-md-5">
                    <div class="row">
                    @if ($host->projects->isEmpty())
                        <p class="fs-4">No has publicado ningún proyecto.</p>
                        <a href="{{route('host.my-projects.create')}}" class="btn btn-primary btn-lg">Publicá tu primer proyecto</a>
                    @else

                        @foreach ($host->projects as $project)

                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 {{ $project->enabled === 0 ? 'border-danger' : '' }}">
                                    <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                                class="card-img-top"
                                                alt="{{ $project->title }}"
                                                style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3 gap-2">
                                            <h3 class="card-title mb-0 h4">
                                                {{ $project->title }}
                                            </h3>
                                            @if($project->enabled != 1)
                                            <span
                                                    class="badge text-capitalize bg-danger">
                                                    desactivado
                                            </span>
                                            @endif
                                        </div>

                                        <p class="card-text small mb-3">
                                            {{ Str::limit($project->description, 100) }}
                                        </p>

                                        @if ($project->enabled === 0)
                                            <p class="text-muted small">Este proyecto se encuentra <span class="text-danger fw-semibold">deshabilitado</span></p>
                                        @endif

                                        <a href="{{ route('host.my-projects.show', $project->id) }}"
                                            class="btn btn-sm btn-azul mt-3">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>

                <div class="col-md-3 bg-body-tertiary rounded py-3">
                    @if ($host->projects->isNotEmpty())
                    <p class="fw-bold">¿Tenés un proyecto nuevo?</p>
                    <a href="{{route('host.my-projects.create')}}" class="btn btn-primary">Crear Proyecto Nuevo</a>
                    <hr class="my-4">
                    @endif
                    <div class="rounded bg-primary bg-opacity-10 border border-primary p-3">
                        @if($lastAppliedVolunteer && $lastAppliedVolunteer->volunteers->isNotEmpty())
                            @php
                                $volunteer = $lastAppliedVolunteer->volunteers->first(); // obtenemos el voluntario
                            @endphp
                            <p class="h5 text-primary fw-semibold">Alguien se postuló a tu proyecto!</p>
                            <p><strong>{{ $volunteer->name }}</strong> aplicó el {{ \Carbon\Carbon::parse($volunteer->pivot->applied_at)->format('d/m/Y') }}
                            y está pendiente de aceptación en el proyecto: <strong>{{ $lastAppliedVolunteer->title }}</strong>
                            </p>
                            <a href="{{route('host.my-projects.show', $lastAppliedVolunteer->id)}}" class="btn btn-outline-primary">Ir al Proyecto</a>
                        @else
                            <p>No hay voluntarios pendientes de revisión.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
