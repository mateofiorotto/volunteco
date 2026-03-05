@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-md-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title-h1 h3 mb-0">Perfil de <span>voluntario</span></h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="d-flex flex-column flex-md-row g-0">
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
                                                class="text-capitalize fw-semibold badge {{ $volunteer->user->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                            {{ $volunteer->user->status }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="card-title h3">{{ $volunteer->full_name }}</h2>
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li><a href="mailto:{{ $volunteer->user->email }}"
                                                    target="_blank">{{ $volunteer->user->email }}</a></li>
                                            <li><a href="tel:{{ $volunteer->phone }}"
                                                    target="_blank">{{ $volunteer->phone }}</a></li>
                                            <li class="text-muted small">{{ $volunteer->location->name ?? 'Sin ubicación' }} -
                                                {{ $volunteer->location->province->name }}</li>
                                        </ul>
                                        <ul class="list-unstyled">
                                            <li>DNI: <span class="text-muted small">{{ number_format($volunteer->dni, 0, ',', '.') }}</span></li>
                                            <li class="text-nowrap">Fecha de
                                                    nacimiento: <span class="text-muted small">{{ $volunteer->birthdate->format('d/m/Y') }}
                                                ({{ $volunteer->birthdate->age }} años)</span></li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul class="list-unstyled mb-0">
                                            <li>Profesión: <span class="text-muted small text-capitalize">{{ $volunteer->profession ?? 'Sin profesión' }}</span></li>
                                            <li>Nivel educativo: <span class="text-muted small text-capitalize">{{ $volunteer->educational_level }}</span></li>
                                            <li>Fecha de registro: <span class="text-muted small">{{ $volunteer->created_at->format('d/m/Y') }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="d-md-flex gap-3">
                        <div class="flex-fill">
                            <div class="card mb-3">
                                <div class="card-header">Biografía</div>
                                <div class="card-body text-muted small">
                                    {{ $volunteer->biography }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card mb-3">
                                <div class="card-header">Redes sociales</div>
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

                    <div class="card mb-3">
                        <div class="card-header">Prestigio</div>
                        <div class="card-body">
                            <x-volunteer-reputation-card :volunteer="$volunteer" />
                        </div>
                    </div>

                </div>
            </div>

            <div>
                <div class="d-flex justify-content-end py-2 gap-2 flex-wrap">
                    <div class="small"><i class="bi bi-circle-fill dot-aceptado"></i> Aceptado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-pendiente"></i> Pendiente</div>
                    <div class="small"><i class="bi bi-circle-fill dot-rechazado"></i> Rechazado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-completado"></i> Completado</div>
                    <div class="small"><i class="bi bi-circle-fill dot-cancelado"></i> Cancelado</div>
                </div>

                <div class="card">
                    <div class="card-header">Proyectos a los que aplicó</div>
                        <div class="card-body">
                            @if ($volunteer->projects->count() > 0)
                                <div class="table-responsive">
                                    <table class="table responsive-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Fechas</th>
                                                <th scope="col">Anfitrión</th>
                                                <th scope="col" class="text-center">Estado del voluntario</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($volunteer->projects as $project)
                                                <tr class="{{ $project->enabled != 1 ? 'table-danger' : '' }} {{$project->pivot->status == 'cancelado' ? 'table-light' : ''}} {{$project->pivot->status == 'completado' ? 'table-light' : ''}}">
                                                    <th scope="row">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div><span class="d-lg-none"># </span>{{ $project->id }}</div>
                                                            <div class="d-lg-none dot-{{$project->pivot->status}}"><i class="bi bi-circle-fill"></i></div>
                                                        </div>
                                                    </th>
                                                    <td data-label="Título: ">{{ $project->title }}</td>
                                                    <td data-label="Fechas: ">
                                                        <div>
                                                            Inicia: <span class="small text-muted">
                                                            {{ $project->start_date->format('d/m/Y') }}</span>
                                                        </div>
                                                        <div>
                                                            Finaliza: <span class="small text-muted">
                                                            {{ $project->end_date->format('d/m/Y') }}</span>
                                                        </div>
                                                    </td>
                                                    <td data-label="Anfitrión:">
                                                        {{$project->host->name}}
                                                    </td>
                                                    <td class="text-center hidden-mb">
                                                        <div class="dot-{{$project->pivot->status}}"><i class="bi bi-circle-fill"></i></div>
                                                    </td>
                                                    <td class="text-lg-center">
                                                        <a href="{{ route('admin.projects.show', $project->id) }}"
                                                        class="btn btn-sm btn-azul"
                                                        title="ver">Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                    <p class="mb-0">Este voluntario no aplicó a ningún proyecto aún</p>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
