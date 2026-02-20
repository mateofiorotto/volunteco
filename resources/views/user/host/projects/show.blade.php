@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Proyecto</h1>
            <a href="{{ url()->previous() }}"
               class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                {{ session('success') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                {{ session('error') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            <!-- Detalles del proyecto -->
            <div class="col-md-8 col-12 mb-4">
                <div class="card flex-row mb-4">
                    @if ($project->image)
                        <div class="ratio ratio-16x9">
                            <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                 class="card-img-top object-fit-cover"
                                 alt="{{ $project->title }}"
                                 width="854"
                                 height="480">
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h2 class="card-title h3">{{ $project->title }}</h2>
                            @if ($project->enabled === 0)
                                <span class="badge text-bg-danger">
                                    Deshabilitado
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="list-unstyled">
                                    <li>Tipo: <span class="text-muted small">{{ $project->projectType->name ?? 'Sin tipo' }}</span></li>
                                    <li>Ubicación: <span class="text-muted small">{{ $project->location->name }} -
                                        {{ $project->location->province->name }}</span></li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-unstyled">
                                    <li>Inicio: <span class="text-muted small">{{ $project->start_date->format('d/m/Y') }}</span></li>
                                    <li>Fin: <span class="text-muted small">{{ $project->end_date->format('d/m/Y') }}</span><li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Descripción del proyecto</div>
                            <div class="card-body text-muted small">
                                {{ $project->description }}
                            </div>
                        </div>

                    </div>
                </div>

                @if ($project->conditions->isNotEmpty())
                    <div class="card">
                        <div class="card-header">Condiciones y requisitos</div>
                        <div class="card-body">
                            <p>Horas por día: <span class="text-muted small">{{ $project->work_hours_per_day }}</span></p>

                            <ul class="list-unstyled mb-0">
                                @foreach ($project->conditions as $condition)
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="bi bi-check2"></i>
                                        <span class="text-muted small">{{ $condition->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="col-md-4 col-12 mb-4">
                <div class="card">
                    <div class="card-header text-bg-primary">
                        <h2 class="h5 mb-0">Acciones</h2>
                    </div>
                    <div class="card-body">
                        <div class="row border-bottom mb-3">
                            <div class="col-md-6">
                                <form method="GET"
                                      action="{{ route('host.my-projects.edit', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-primary w-100 mb-3"
                                            type="submit">
                                        Editar
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="#volunteers-list">
                                    <button class="btn btn-primary w-100 mb-3"
                                            type="submit">
                                        Ver voluntarios
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div>
                            <form method="POST"
                                  action="{{ route('host.my-projects.updateEnabled', $project->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-2">Estado</div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="enabled"
                                           id="enabled"
                                           value="1"
                                           {{ $project->enabled ? 'checked' : '' }} />
                                    <label class="form-check-label small"
                                           for="enabled">
                                        Deshabilitado / Habilitado
                                    </label>
                                </div>
                                <button type="submit"
                                        class="btn-primary btn btn-sm">Confirmar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-host.projects-volunteers-list :registeredVolunteers="$registeredVolunteers" :project="$project" />

    </section>
@endsection
