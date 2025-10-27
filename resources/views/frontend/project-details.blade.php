@extends('layouts.app')

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
                        @if ($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top object-fit-contain" alt="{{ $project->title }}" width="400" height="400">
                        @endif

                        <div class="card-body">
                            <h2 class="card-title fw-bold">{{ $project->title }}</h2>
                            <p class="card-text">{{ $project->description }}</p>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                        <div>
                                            <h4 class="h6 fw-semibold mb-1">Ubicación</h4>
                                            <p class="mb-0">{{ $project->location }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-clock fs-5 text-primary"></i>
                                        <div>
                                            <h4 class="h6 fw-semibold mb-1">Horas por día</h4>
                                            <p class="mb-0">{{ $project->work_hours_per_day }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                        <div>
                                            <h4 class="h6 fw-semibold mb-1">Fecha de inicio</h4>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                        <div>
                                            <h4 class="h6 fw-semibold mb-1">Fecha de finalización</h4>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($project->conditions->isNotEmpty())
                                <div class="mt-4">
                                    <div class="d-flex gap-2 align-items-start mb-3">
                                        <i class="bi bi-clipboard2-check fs-5 text-primary"></i>
                                        <h4 class="h6 fw-semibold mb-0">Condiciones y Requisitos</h4>
                                    </div>
                                    <ul class="list-unstyled ms-4">
                                        @foreach ($project->conditions as $condition)
                                            <li class="mb-2 d-flex gap-2 align-items-start">
                                                <i class="bi bi-check2 fs-5 text-primary"></i>
                                                <span>{{ $condition->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Anfitrión</h2>

                            <div class="d-flex align-items-center gap-3 mb-3">
                                @if ($project->host->avatar)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $project->host->avatar) }}"
                                            class="img-fluid rounded-start object-fit-cover"
                                            alt="Foto de {{ $project->host->name }}"
                                            width="150" height="50"
                                            >
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <p class="text-dark fw-semibold">{{ $project->host->name }}</p>
                                </div>
                            </div>

                            @if ($project->host->location)
                                <div class="mb-3 d-flex gap-2 align-items-center">
                                    <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                    <p>{{ $project->host->location }}</p>
                                </div>
                            @endif

                            <div class="d-flex gap-2">
                                @if ($project->host->linkedin)
                                    <a href="{{ $project->host->linkedin }}" target="_blank" class="btn btn-link"><i class="bi bi-linkedin"></i></a>
                                @endif

                                @if ($project->host->instagram)
                                    <a href="{{ $project->host->instagram }}" target="_blank" class="btn btn-link"><i class="bi bi-instagram"></i></a>
                                @endif

                                @if ($project->host->facebook)
                                    <a href="{{ $project->host->facebook }}" target="_blank" class="btn btn-link"><i class="bi bi-facebook"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Botones de acción para voluntarios --}}
                    @if (Auth::check() && Auth::user()->hasRole('volunteer'))
                        <div class="card mt-3">
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
                                            <button class="btn btn-danger" type="submit"> Desistir del proyecto</button>
                                        </form>
                                    @endif
                                @else
                                    <p class="mb-3">¿Te interesa participar en este proyecto?</p>
                                    <form method="POST"
                                        action="{{ route('apply-project', $project->id) }}">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Aplicar al proyecto</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
