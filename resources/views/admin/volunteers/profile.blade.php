@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Perfil de <span>Voluntario</span></h1>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="d-flex g-0">
                                        @if (!empty($volunteer->volunteer->avatar))
                                            <div class="avatar p-3">
                                                <img src="{{ asset('storage/' . $volunteer->volunteer->avatar) }}"
                                                    alt="Foto de perfil de {{ $volunteer->full_name }}"
                                                    class="img-fluid object-fit-contain rounded-circle"
                                                    width="80"
                                                    height="80">
                                            </div>
                                        @endif
                                        <div class="card-body flex-fill">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="small text-muted">Voluntario</div>
                                                @if ($volunteer->status !== 'activo')
                                                    <span class="text-uppercase fw-semibold badge {{ $volunteer->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                                        {{ $volunteer->status }}
                                                    </span>
                                                @endif
                                            </div>
                                            <h2 class="card-title h3">{{ $volunteer->volunteer->full_name }}</h2>
                                            <div class="row gap-5">
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><a href="mailto:{{ $volunteer->email }}" target="_blank">{{ $volunteer->email }}</a></li>
                                                        <li>{{ $volunteer->volunteer->phone }}</li>
                                                        <li>{{ $volunteer->volunteer->location->name ?? 'Sin ubicación' }} - {{$volunteer->volunteer->location->province->name}}</li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><i class="bi bi-person-vcard text-primary me-2"></i>{{ number_format($volunteer->volunteer->dni, 0, ',', '.') }}</li>
                                                        <li><span class="text-muted small">Fecha de nacimiento: </span>{{ $volunteer->volunteer->birthdate->format('d/m/Y') }}</li>
                                                        <li><span class="text-muted small">Fecha de registro: </span>{{ $volunteer->created_at->format('d/m/Y') }}</li>
                                                    </ul>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><span class="text-muted small">Profesión: </span><span class="text-capitalize">{{ $volunteer->volunteer->profession ?? 'Sin profesión' }}</span></li>
                                                        <li><span class="text-muted small">Nivel educativo: </span><span class="text-capitalize">{{ $volunteer->volunteer->educational_level }}</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card mb-3">
                                    <div class="card-header">Biografía</div>
                                    <div class="card-body">
                                        {{ $volunteer->volunteer->biography }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card mb-3">
                                    <div class="card-header">Redes Sociales</div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <span><i class="bi bi-linkedin fs-5 me-2 text-azul"></i></span>
                                                @if ($volunteer->volunteer->linkedin)
                                                    <a href="{{ $volunteer->volunteer->linkedin }}"
                                                       target="_blank">{{ $volunteer->volunteer->linkedin }}</a>
                                                @else
                                                    Sin datos
                                                @endif
                                            </li>
                                            <li>
                                                <span><i class="bi bi-instagram fs-5 me-2 text-azul"></i></span>
                                                @if ($volunteer->volunteer->instagram)
                                                    <a href="{{ $volunteer->volunteer->instagram }}"
                                                       target="_blank">{{ $volunteer->volunteer->instagram }}</a>
                                                @else
                                                    Sin datos
                                                @endif
                                            </li>
                                            <li>
                                                <span><i class="bi bi-facebook fs-5 me-2 text-azul"></i></span>
                                                @if ($volunteer->volunteer->facebook)
                                                    <a href="{{ $volunteer->volunteer->facebook }}"
                                                       target="_blank">{{ $volunteer->volunteer->facebook }}</a>
                                                @else
                                                    Sin datos
                                                @endif
                                            </li>
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
                            @if ($volunteer->status == 'inactivo')
                                <p class="alert-danger alert">Este voluntario está desactivado</p>
                                <div class="border-top pt-3 d-flex justify-content-between">
                                    <form method="POST"
                                          action="{{ route('admin.reenable-volunteer-profile', $volunteer->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-danger mb-3"
                                                type="submit">Reactivar</button>
                                    </form>
                                </div>
                                <div class="pt-3 border-top">
                                    <form method="POST"
                                          class="d-flex flex-column"
                                          action="{{ route('admin.delete-volunteer-profile', $volunteer->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-3">
                                            <button class="btn btn-danger ms-auto"
                                                    type="submit">Eliminar Definitivamente</button>
                                        </div>
                                    </form>
                                </div>
                            @elseif($volunteer->status == 'activo')
                                <form method="POST"
                                      action="{{ route('admin.disable-volunteer-profile', $volunteer->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                            class="btn btn-outline-primary">Desactivar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">Proyectos a los que aplicó</div>
                    <ul class="list-group list-group-flush">
                        @if ($volunteer->volunteer->projects->count() > 0)
                            @foreach ($volunteer->volunteer->projects as $project)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-4">{{ $project->title }}</div>
                                        <div class="col-12 col-md-4">
                                            Inicia: {{ $project->start_date }}
                                        </div>
                                        <div class="col-12 col-md-2">
                                            X voluntarios postulados
                                            X voluntarios activos
                                        </div>
                                        <div class="col-12 col-md-2 text-center">
                                            <a href=""
                                               class="btn btn-sm btn-azul"
                                               title="ver">
                                                Ver
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-4">Este voluntario no aplico a ningun proyecto</div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
