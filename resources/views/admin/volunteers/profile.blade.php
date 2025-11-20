@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Perfil de <span>Voluntario</span></h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="d-flex g-0">
                                        <div class="avatar p-3">
                                            <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                                 alt="Foto de perfil de {{ $volunteer->full_name }}"
                                                 class="object-fit-contain rounded-circle"
                                                 width="80"
                                                 height="80">
                                        </div>
                                        <div class="card-body flex-fill">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="small text-muted">Voluntario</div>
                                                @if ($volunteer->user->status !== 'activo')
                                                    <span
                                                          class="text-uppercase fw-semibold badge {{ $volunteer->user->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                                        {{ $volunteer->user->status }}
                                                    </span>
                                                @endif
                                            </div>
                                            <h2 class="card-title h3">{{ $volunteer->full_name }}</h2>
                                            <div class="row gap-5">
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><a href="mailto:{{ $volunteer->user->email }}"
                                                               target="_blank">{{ $volunteer->user->email }}</a></li>
                                                        <li><a href="tel:{{ $volunteer->phone }}"
                                                               target="_blank">{{ $volunteer->phone }}</a></li>
                                                        <li>{{ $volunteer->location->name ?? 'Sin ubicación' }} -
                                                            {{ $volunteer->location->province->name }}</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li><span class="text-muted small">DNI:
                                                            </span>{{ number_format($volunteer->dni, 0, ',', '.') }}</li>
                                                        <li class="text-nowrap"><span class="text-muted small">Fecha de
                                                                nacimiento:
                                                            </span>{{ $volunteer->birthdate->format('d/m/Y') }}
                                                            ({{ $volunteer->birthdate->age }} años)</li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-unstyled mb-0">
                                                        <li><span class="text-muted small">Profesión: </span><span
                                                                  class="text-capitalize">{{ $volunteer->profession ?? 'Sin profesión' }}</span>
                                                        </li>
                                                        <li><span class="text-muted small">Nivel educativo: </span><span
                                                                  class="text-capitalize">{{ $volunteer->educational_level }}</span>
                                                        </li>
                                                        <li><span class="text-muted small">Fecha de registro:
                                                            </span>{{ $volunteer->created_at->format('d/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-md-flex gap-3">
                                <div class="flex-fill">
                                    <div class="card mb-3">
                                        <div class="card-header">Biografía</div>
                                        <div class="card-body">
                                            {{ $volunteer->biography }}
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="card mb-3">
                                        <div class="card-header">Redes Sociales</div>
                                        <div class="card-body">
                                            @if ($volunteer->linkedin || $volunteer->facebook || $volunteer->instagram)
                                                <ul class="list-unstyled mb-0">
                                                    @if ($volunteer->linkedin)
                                                        <li>
                                                            <a href="{{ $volunteer->linkedin }}"
                                                               target="_blank"
                                                               class="text-nowrap"><i
                                                                   class="bi bi-linkedin fs-5 me-2 text-azul"></i>
                                                                {{ $volunteer->linkedin }}</a>
                                                        </li>
                                                    @endif

                                                    @if ($volunteer->instagram)
                                                        <li>
                                                            <a href="{{ $volunteer->instagram }}"
                                                               target="_blank"
                                                               class="text-nowrap"><i
                                                                   class="bi bi-instagram fs-5 me-2 text-azul"></i>
                                                                {{ $volunteer->instagram }}</a>
                                                        </li>
                                                    @endif
                                                    @if ($volunteer->facebook)
                                                        <li>
                                                            <a href="{{ $volunteer->facebook }}"
                                                               target="_blank"
                                                               class="text-nowrap"><i
                                                                   class="bi bi-facebook fs-5 me-2 text-azul"></i>
                                                                {{ $volunteer->facebook }}</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @else
                                                <p class="mb-0">No tiene cargada ninguna red social</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Acciones</div>
                        <div class="card-body">

                            {{-- Si el perfil esta pendiente --}}
                            @if ($volunteer->user->status !== 'activo')
                                <p
                                   class="alert {{ $volunteer->user->status == 'pendiente' ? 'alert-warning' : 'alert-danger' }}">
                                    Este voluntario está {{ $volunteer->user->status }}</p>

                                <div class="border-top pt-3 d-flex justify-content-between">
                                    <form method="POST"
                                          action="{{ route('admin.reenable-volunteer-profile', $volunteer->user_id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-danger mb-3"
                                                type="submit">Reactivar</button>
                                    </form>
                                </div>
                                @if ($volunteer->user->status == 'inactivo')
                                    <div class="pt-3 border-top">
                                        <form method="POST"
                                              class="d-flex flex-column"
                                              action="{{ route('admin.delete-volunteer-profile', $volunteer->user_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mb-3">
                                                <button class="btn btn-danger ms-auto"
                                                        type="submit">Eliminar Definitivamente</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <form method="POST"
                                      action="{{ route('admin.disable-volunteer-profile', $volunteer->user_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                            class="btn btn-outline-danger">Desactivar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="card">
                    <div class="card-header">Proyectos a los que aplicó</div>
                    @if ($volunteer->projects->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="fw-semibold">Título</th>
                                    <th scope="col"
                                        class="fw-semibold">Fechas</th>
                                    <th scope="col"
                                        class="fw-semibold">Estado</th>
                                    <th scope="col"
                                        class="fw-semibold">Anfitrión</th>
                                    <th scope="col"
                                        class="fw-semibold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($volunteer->projects as $project)
                                    <tr class="{{ $project->enabled != 1 ? 'table-danger' : '' }}">
                                        <td>{{ $project->title }}</td>
                                        <td>
                                            <div>
                                                <span class="small text-muted">Inicia: </span>
                                                {{ $project->start_date->format('d/m/Y') }}
                                            </div>
                                            <div>
                                                <span class="small text-muted">Finaliza:
                                                </span>{{ $project->end_date->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($project->enabled != 1)
                                                <span class="badge bg-danger">Deshabilitado</span>
                                            @else
                                                <span class="badge bg-transparent text-body">Activo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="mb-0 small">{{$project->host->name}}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.show', $project->id) }}"
                                               class="btn btn-sm btn-azul"
                                               title="ver">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card-body">
                            <p class="mb-0">Este voluntario no aplico a ningun proyecto aún</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
