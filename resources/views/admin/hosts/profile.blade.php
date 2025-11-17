@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Perfil de <span>Anfitrión</span></h1>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="d-flex g-0">
                                        <div class="avatar avatar-host p-3">
                                            <img src="{{ asset('storage/' . ($host->host->avatar ?? 'perfil-host.svg')) }}"
                                                    alt="Foto de perfil"
                                                    class="object-fit-contain rounded-circle"
                                                    width="80"
                                                    height="80">
                                        </div>
                                        <div class="card-body flex-fill">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="small text-muted">Anfitrión</div>
                                                @if ($host->status !== 'activo')
                                                    <span class="text-uppercase fw-semibold badge {{ $host->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                                        {{ $host->status }}
                                                    </span>
                                                @endif
                                            </div>
                                            <h2 class="card-title h3">{{ $host->host->name }}</h2>
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="list-unstyled mb-3">
                                                        <li><a href="mailto:{{ $host->email }}" target="_blank">{{ $host->email }}</a></li>
                                                        <li><a href="tel:{{ $host->host->phone }}" target="_blank">{{ $host->host->phone }}</a></li>
                                                        <li>{{ $host->host->location->name ?? 'Sin ubicación' }} - {{$host->host->location->province->name}}</li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-unstyled mb-0">
                                                        <li><span class="text-muted small">CUIT:</span> {{ $host->host->cuit }}</li>
                                                        <li><span class="text-muted small">Contacto:</span> {{ $host->host->person_full_name }}</li>
                                                        <li><span class="text-muted small">Fecha de registro:</span> {{ $host->created_at->format('d/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-header">Descripción</div>
                                    <div class="card-body">
                                        {{ $host->host->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header">Redes Sociales</div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            @if ($host->host->linkedin)
                                                <li>
                                                    <a href="{{ $host->host->linkedin }}" target="_blank"><i class="bi bi-linkedin fs-5 me-2 text-azul align-middle"></i> {{ $host->host->linkedin }}</a>
                                                </li>
                                            @endif
                                            @if ($host->host->instagram)
                                                <li>
                                                    <a href="{{ $host->host->instagram }}" target="_blank"><i class="bi bi-instagram fs-5 me-2 text-azul align-middle"></i> {{ $host->host->instagram }}</a>
                                                </li>
                                            @endif
                                            @if ($host->host->facebook)
                                                <li>
                                                    <a href="{{ $host->host->facebook }}" target="_blank"><i class="bi bi-facebook fs-5 me-2 text-azul align-middle"></i> {{ $host->host->facebook }}</a>
                                                </li>
                                            @endif
                                        </ul>
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
                            @if ($host->status == 'pendiente')
                                <div>
                                    @if ($host->host->disabled_at || $host->host->rejection_reason)
                                        <div class="alert-warning alert">
                                            <p class="mb-0 fw-semibold">Último mensaje</p>
                                            <ul class="list-unstyled mb-0">
                                                @if ($host->host->disabled_at)
                                                    <li><span class="text-muted small">Fecha:</span>
                                                        {{ $host->host->disabled_at->format('d/m/Y') }}</li>
                                                @endif
                                                @if ($host->host->rejection_reason)
                                                    <li><span class="text-muted small">Motivo:</span>
                                                        <p class="mb-0">{{ $host->host->rejection_reason }}</p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($host->host->rejection_reason != null)
                                        <div class="mb-3 text-end">
                                            <form method="POST"
                                                  action="{{ route('admin.send-host-rejected-reminder', $host->id) }}">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-outline-primary"
                                                        type="submit">Enviar Recordatorio</button>
                                            </form>
                                        </div>
                                    @else
                                        <form method="POST"
                                              class="d-flex flex-column mb-3"
                                              action="{{ route('admin.send-mail-disabled-profile', $host->id) }}">
                                            @csrf

                                            <div class="mb-3">
                                                {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                                                <label class="form-label"
                                                       for="description">Mensaje:</label>
                                                <textarea required
                                                          id="description"
                                                          name="description"
                                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                          rows="3">{{ old('description') }}</textarea>
                                                @if ($errors->has('description'))
                                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                                @endif
                                                <p class="form-text">Indicá los motivos que debe corregir o completar para
                                                    que podamos aceptar su perfil.</p>
                                            </div>
                                            <button class="btn btn-outline-primary ms-auto"
                                                    type="submit">Enviar Email y Desactivar</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="border-top pt-3 d-flex justify-content-between">
                                    <form method="POST"
                                          action="{{ route('admin.disable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-danger"
                                                type="submit">Desactivar</button>
                                    </form>
                                    <form method="POST"
                                          action="{{ route('admin.enable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="btn btn-primary">Activar</button>
                                    </form>
                                </div>

                                {{-- Si el perfil esta inactivo --}}
                            @elseif ($host->status == 'inactivo')
                                <p class="alert-danger alert">Este anfitrión está desactivado</p>
                                <div class="d-flex flex-column mb-3">
                                    @if ($host->host->disabled_at || $host->host->rejection_reason)
                                        <ul class="list-unstyled">
                                            @if ($host->host->disabled_at)
                                                <li><span class="text-muted small">Fecha de desactivación:</span>
                                                    {{ $host->host->disabled_at->format('d/m/Y') }}</li>
                                            @endif
                                            @if ($host->host->rejection_reason)
                                                <li><span class="text-muted small">Motivo:</span>
                                                    <p class="mb-0">{{ $host->host->rejection_reason }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>

                                <div class="d-flex mb-3 justify-content-between pt-3 border-top">
                                    <form method="POST"
                                          action="{{ route('admin.pending-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-secondary"
                                                type="submit">Enviar a Pendiente</button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('admin.reenable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary"
                                                type="submit">Activar</button>
                                    </form>
                                </div>
                                {{-- eliminar perfil definitivamente --}}
                                <div class="pt-3 border-top">
                                    <form method="POST"
                                          class="d-flex flex-column"
                                          action="{{ route('admin.delete-host-profile', $host->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-3">
                                            <label for="delete_reasons"
                                                   class="form-label">Motivo de eliminación:</label>
                                            <textarea required
                                                      id="delete_reasons"
                                                      name="delete_reasons"
                                                      class="form-control {{ $errors->has('delete_reasons') ? 'is-invalid' : '' }}"
                                                      rows="3">{{ old('delete_reasons') }}</textarea>
                                            @if ($errors->has('delete_reasons'))
                                                <p class="text-danger">{{ $errors->first('delete_reasons') }}</p>
                                            @endif
                                            <p class="form-text">Indicá los motivos por los que eliminamos su perfil.</p>
                                        </div>
                                        <button class="btn btn-danger ms-auto"
                                                type="submit">Eliminar Definitivamente</button>
                                    </form>
                                </div>
                                {{-- Si el perfil esta activo --}}
                            @else
                                <div>
                                    <form method="POST"
                                          class="d-flex flex-column mb-3"
                                          action="{{ route('admin.send-mail-disabled-profile', $host->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                                            <label for="description"
                                                   class="form-label">Mensaje:</label>
                                            <textarea required
                                                      name="description"
                                                      id="description"
                                                      class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                      rows="3">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                            <p class="form-text">Indicá los motivos por los que desactivamos su perfil.</p>
                                        </div>
                                        <button class="btn btn-outline-primary ms-auto"
                                                type="submit">Enviar Email y Desactivar</button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div>

                {{-- Agregar el listado de todos los proyectos con un link de ver cada proyecto tal cual el host --}}
                <div class="card">
                    <div class="card-header">Proyectos del anfitrión</div>
                    @if ($host->host->projects->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-semibold">Título</th>
                                    <th scope="col" class="fw-semibold">Fechas</th>
                                    <th scope="col" class="fw-semibold">Estado</th>
                                    <th scope="col" class="fw-semibold">Voluntarios</th>
                                    <th scope="col" class="fw-semibold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($host->host->projects as $project)
                                <tr class="{{$project->enabled != 1 ? 'table-danger' : ''}}" >
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
                                        @if($project->enabled != 1)
                                            <span class="badge bg-danger">Deshabilitado</span>
                                        @else
                                            <span class="badge bg-transparent text-body">Activo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->volunteers->isEmpty())
                                            <p class="mb-0 small">No hay voluntarios asociados a este proyecto.</p>
                                        @else
                                            <p class="mb-0 small">Hay {{$project->volunteers->count()}} voluntarios</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $project->id)}}" class="btn btn-sm btn-azul" title="ver">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card-body">
                            <p class="mb-0">Este anfitrión no tiene proyectos cargados</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
