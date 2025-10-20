@extends('layouts.app')

@section('content')
    <section class="container text-break pt-5 pb-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Detalles del proyecto</h2>

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

                <div class="card mb-4">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}"
                             class="card-img-top"
                             alt="{{ $project->title }}"
                             style="max-height: 400px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $project->title }}</h3>

                        <div class="mb-3">
                            <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                            @if ($project->enabled)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </div>

                        <h5>Descripción</h5>
                        <p class="card-text">{{ $project->description }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Ubicación</h5>
                                <p>{{ $project->location }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Horas por día</h5>
                                <p>{{ $project->work_hours_per_day }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h5>Fecha de inicio</h5>
                                <p>{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Fecha de finalización</h5>
                                <p>{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        @if ($project->conditions->isNotEmpty())
                            <h5 class="mt-4">Condiciones y Requisitos</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($project->conditions as $condition)
                                    <li class="list-group-item">{{ $condition->name }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="mt-4">
                            <h5>🏢 Organización</h5>
                            <p class="mb-1"><strong>{{ $project->host->name }}</strong></p>
                            <p class="text-muted small">{{ $project->host->description }}</p>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción para voluntarios --}}
                @if (Auth::check() && Auth::user()->hasRole('volunteer'))
                    <div class="card">
                        <div class="card-body">
                            @if ($hasApplied)
                                @php
                                    $application = Auth::user()
                                        ->volunteer->projects()
                                        ->where('project_id', $project->id)
                                        ->first();
                                    $status = $application ? $application->pivot->status : null;
                                @endphp

                                @if ($status === 'pendiente')
                                    <div class="alert alert-info mb-3">
                                        <strong>Solicitud Pendiente</strong><br>
                                        Tu solicitud está siendo revisada por el anfitrión.
                                    </div>
                                @elseif($status === 'aceptado')
                                    <div class="alert alert-success mb-3">
                                        <strong>Solicitud Aceptada</strong><br>
                                        ¡Felicitaciones! Has sido aceptado en este proyecto.
                                    </div>
                                @elseif($status === 'rechazado')
                                    <div class="alert alert-danger mb-3">
                                        <strong>Solicitud Rechazada</strong><br>
                                        Lamentablemente tu solicitud no fue aceptada para este proyecto.
                                    </div>
                                @endif

                                @if ($status !== 'rechazado')
                                    <form method="POST"
                                          action="{{ route('withdraw-project', $project->id) }}"
                                          onsubmit="return confirm('¿Estás seguro de que deseas desistir de este proyecto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                                type="submit">
                                            Desistir del proyecto
                                        </button>
                                    </form>
                                @endif
                            @else
                                <p class="mb-3">¿Te interesa participar en este proyecto?</p>
                                <form method="POST"
                                      action="{{ route('apply-project', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-primary btn-lg"
                                            type="submit">
                                        Aplicar al proyecto
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información de Contacto</h5>

                        @if ($project->host->person_full_name)
                            <p class="mb-2">
                                <strong>Contacto:</strong><br>
                                {{ $project->host->person_full_name }}
                            </p>
                        @endif

                        @if ($project->host->phone)
                            <p class="mb-2">
                                <strong>Teléfono:</strong><br>
                                {{ $project->host->phone }}
                            </p>
                        @endif

                        @if ($project->host->location)
                            <p class="mb-2">
                                <strong>Ubicación:</strong><br>
                                {{ $project->host->location }}
                            </p>
                        @endif

                        <hr>

                        <h6>Redes Sociales</h6>
                        <div class="d-flex gap-2">
                            @if ($project->host->facebook)
                                <a href="{{ $project->host->facebook }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    Facebook
                                </a>
                            @endif
                            @if ($project->host->instagram)
                                <a href="{{ $project->host->instagram }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-danger">
                                    Instagram
                                </a>
                            @endif
                            @if ($project->host->linkedin)
                                <a href="{{ $project->host->linkedin }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-info">
                                    LinkedIn
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ url()->previous() }}"
               class="btn btn-outline-secondary">
                Volver
            </a>
        </div>
    </section>
@endsection
