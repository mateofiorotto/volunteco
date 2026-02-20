@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <section>
        <div class="container pt-5 pb-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Proyecto</h1>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>

            <!-- Alerta de exito temporal -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Alerta de error temporal mas adelante cambiar por swal2 o algo mas lindo -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row mb-5">

                <!-- Detalles del proyecto -->
                <div class="col-md-8 col-12 mb-4">
                    <div class="card">
                        <div class="ratio ratio-16x9">
                            <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                 class="card-img-top object-fit-cover"
                                 alt="{{ $project->title }}"
                                 width="854"
                                 height="480">
                        </div>

                        <div class="card-body">
                            <div class="d-flex flex-md-row-reverse gap-5 mb-3">
                                <div><span class="badge bg-primary mb-2">{{ $project->projectType->name }}</span></div>
                                <div>
                                    <h2 class="card-title h3">{{ $project->title }}</h2>
                                    <p class="card-text text-muted">{{ $project->description }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                        <div class="pt-1">
                                            <h4 class="h6 fw-semibold mb-1">Ubicación</h4>
                                            <p class="mb-0 text-muted small">
                                                {{ $project->location_id ? $project->location->name . ' - ' . $project->location->province->name : '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-clock fs-5 text-primary"></i>
                                        <div class="pt-1">
                                            <h4 class="h6 fw-semibold mb-1">Horas por día</h4>
                                            <p class="mb-0 text-muted small">{{ $project->work_hours_per_day }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                        <div class="pt-1">
                                            <h4 class="h6 fw-semibold mb-1">Inicia</h4>
                                            <p class="mb-0 text-muted small">
                                                {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                        <div class="pt-1">
                                            <h4 class="h6 fw-semibold mb-1">Finaliza</h4>
                                            <p class="mb-0 text-muted small">
                                                {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($project->conditions->isNotEmpty())
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-clipboard2-check fs-5 text-primary"></i>
                                    <div class="pt-1">
                                        <h4 class="h6 fw-semibold">Condiciones y requisitos</h4>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($project->conditions as $condition)
                                                <li class="d-flex gap-2 align-items-center ">
                                                    <i class="bi bi-check2 fs-5 text-primary"></i>
                                                    <span class="text-muted small">{{ $condition->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4 col-12">
                    <x-host.profile-sidebar
                        :project="$project"
                        :isAceptedByHost="$isAceptedByHost"
                        :isInHostRoster="$isInHostRoster"
                    />

                    {{-- Evaluación del host sobre su desempeño en este proyecto --}}
                    @if($isAceptedByHost)
                    <hr>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h3 class="card-title h5">Evaluación del anfitrión</h3>
                            <p class="small">Esta evaluación destaca tus fortalezas y refleja tu compromiso durante la experiencia.<br>Tomala como una herramienta para seguir creciendo.</p>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">Desempeño: <span class="text-muted">{{$evaluation->performance_label}}</span></li>
                                <li class="mb-2">Fortalezas destacadas:<br><span class="text-muted p-3 fst-italic">"{{$evaluation->strengths}}"</span></li>
                                <li>Aspectos a mejorar:<br><span class="text-muted p-3 fst-italic">"{{$evaluation->improvements}}"</span></li>
                            </ul>
                        </div>
                    </div>
                    @endif

                    {{-- Botones de acción para voluntarios --}}
                    <x-volunteer.project-actions
                        :project="$project"
                        :volunteerStatus="$volunteerStatus"
                    />
                </div>

            </div>
        </div>
    </section>
@endsection
