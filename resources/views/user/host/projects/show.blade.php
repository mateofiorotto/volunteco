@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3 mb-0">Proyecto</h1>
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-5">
            <!-- Detalles del proyecto -->
            <div class="col-md-8 col-12 mb-4">
                <div class="card">
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
                        <h3 class="card-title fw-bold">{{ $project->title }}</h3>

                        <p class="card-text">{{ $project->description }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Ubicación</h4>
                                        <p class="mb-0">{{ $project->location_id ? $project->location->name . ' - ' . $project->location->province->name : ''}}</p>
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
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="bi bi-calendar4 fs-5 text-primary"></i>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Fecha de finalización</h4>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</p>
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
                                            <i class="bi bi-check2"></i>
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
                        <h3 class="card-title">Acciones</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('host.my-projects.edit', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-primary w-100 mb-3" type="submit">
                                        Editar
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('host.my-projects.delete', $project->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-primary w-100 mb-3" type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <a href="#volunteers-list">
                                    <button class="btn btn-secondary text-light w-100 mb-3" type="submit">
                                        Ver voluntarios que aplicaron
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="volunteers-list" class="row">
            <div class="card p-0 border-primary">
                <div class="card-header text-bg-primary">
                    <h3 class="h5 mb-0">Voluntarios <span class="fw-light">que aplicaron</span></h3>
                </div>
                <div class="card-body">
                    @if ($registeredVolunteers->isEmpty())
                        <p>No hay voluntarios inscritos en este proyecto.</p>
                    @else
                        <table class="table border-primary">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registeredVolunteers as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id }}</th>
                                        <td>{{ $volunteer->full_name }}</td>
                                        <td>
                                            @if ($volunteer->pivot->status !== 'aceptado')
                                                <span class="text-uppercase fw-semibold badge {{ $volunteer->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                                    {{ $volunteer->pivot->status }}
                                                </span>
                                            @else
                                                <span class="text-uppercase fw-semibold badge bg-success">{{ $volunteer->pivot->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('volunteer.volunteer-profile', $volunteer->id) }}" class="btn btn-azul" title="ver">Ver Perfil</a>
                                                @if ($volunteer->pivot->status !== 'aceptado')
                                                    <form method="POST" action="{{ route('host.my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('host.my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-outline-primary">Rechazar</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
