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

        <div class="row">
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
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h2 class="card-title h3">{{ $project->title }}</h2>
                            @if (!$project->enabled)
                                <span class="badge text-bg-danger">
                                    Deshabilitado
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="list-unstyled">
                                    <li><span class="text-muted small">Tipo:
                                        </span>{{ $project->projectType->name ?? 'Sin tipo' }}</li>
                                    <li><span class="text-muted small">Ubicación: </span>{{ $project->location->name }} -
                                        {{ $project->location->province->name }}</li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-unstyled">
                                    <li><span class="text-muted small">Inicio:
                                        </span>{{ $project->start_date->format('d/m/Y') }}</li>
                                    <li><span class="text-muted small">Fin: </span>{{ $project->end_date->format('d/m/Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Descripción del Proyecto</div>
                            <div class="card-body">
                                {{ $project->description }}
                            </div>
                        </div>

                        @if ($project->conditions->isNotEmpty())
                            <div class="card">
                                <div class="card-header">Condiciones y Requisitos</div>
                                <div class="card-body">
                                    <p><span class="text-muted small">Horas por día:
                                        </span>{{ $project->work_hours_per_day }}</p>

                                    <ul class="list-unstyled mb-0">
                                        @foreach ($project->conditions as $condition)
                                            <li class="mb-2 d-flex gap-2 align-items-start">
                                                <i class="bi bi-check2"></i>
                                                <span>{{ $condition->name }}</span>
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
                                        Ver Voluntarios
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
                                        class="btn-outline-primary btn btn-sm">Confirmar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="volunteers-list">
            <div class="card p-0 border-primary">
                <div class="card-header text-bg-primary">
                    <h2 class="h5 mb-0">Voluntarios <span class="fw-light">que aplicaron</span></h2>
                </div>

                @if ($registeredVolunteers->isEmpty())
                <div class="card-body">
                    <p class="mb-0">No hay voluntarios inscriptos en este proyecto.</p>
                </div>
                @else
                    <table class="table border-primary">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registeredVolunteers as $volunteer)
                                <tr class="{{$volunteer->user->status !== 'activo' ? 'table-danger' : ''}}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                                alt="Avatar de {{ $volunteer->full_name }}"
                                                class="rounded-circle me-2"
                                                width="40"
                                                height="40">
                                            {{ $volunteer->full_name }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($volunteer->user->status == 'activo')
                                            @if ($volunteer->pivot->status !== 'aceptado')
                                                <span
                                                    class="text-capitalize badge {{ $volunteer->pivot->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                                    {{ $volunteer->pivot->status }}
                                                </span>
                                            @else
                                                <span class="text-capitalize badge text-body">
                                                    {{ $volunteer->pivot->status }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-capitalize badge text-bg-danger }}">{{ $volunteer->user->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            @if($volunteer->user->status == 'activo')
                                            <a href="{{ route('host.volunteers.profile', $volunteer->id) }}"
                                                class="btn btn-sm btn-azul"
                                                title="ver">Ver Perfil</a>
                                            @endif
                                            @if ($volunteer->pivot->status !== 'aceptado')
                                                <form method="POST"
                                                        action="{{ route('host.my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-primary {{$volunteer->user->status !== 'activo' ? 'disabled' : ''}} {{ $project->enabled == false ? 'disabled' : '' }}">Aceptar</button>
                                                </form>
                                            @else
                                                <form method="POST"
                                                        action="{{ route('host.my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger {{$volunteer->user->status !== 'activo' ? 'disabled' : ''}}" >Rechazar</button>
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
    </section>
@endsection
