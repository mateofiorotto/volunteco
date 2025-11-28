@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3">Perfil <span>del voluntario</span></h1>
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                <strong>¡Perfecto!</strong> {{ session('success') }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        <!-- Perfil -->
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-start">
                            <!-- Foto de perfil -->
                            <div class="avatar">
                                <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                     alt="Foto de perfil de {{ $volunteer->full_name }}"
                                     class="rounded-circle object-fit-contain avatar-lg"
                                     width="200"
                                     height="200">
                            </div>

                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $volunteer->full_name }}</h2>
                                <!-- Info Grid -->
                                @if ($volunteer->location_id)
                                    <div class="d-flex align-items-start">
                                        <p>{{ $volunteer->location->name }} - {{ $volunteer->location->province->name }}</p>
                                    </div>
                                @endif
                                <ul class="list-unstyled">
                                    @if ($volunteer->birthdate)
                                        <li><span class="text-muted small">Edad: </span>{{ $volunteer->birthdate->age }}
                                            años</li>
                                    @endif
                                </ul>
                                <ul class="list-unstyled mb-0">
                                    <li><span class="text-muted small">Profesión: </span><span
                                            class="text-capitalize">{{ $volunteer->profession }}</span></li>
                                    <li><span class="text-muted small">Nivel educativo: </span><span
                                            class="text-capitalize">{{ $volunteer->educational_level }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Biografía</div>
                    <div class="card-body">
                        <p class="mb-0">{{ $volunteer->biography }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-header">Datos de contacto</div>
                    <div class="card-body">
                        @if ($hasAccepted)
                            <ul class="list-unstyled mb-0">
                                <li><span class="text-muted small">Teléfono: </span>{{ $volunteer->phone }}</li>
                                <li><span class="text-muted small">Email: </span>{{ $volunteer->user->email }}</li>
                            </ul>
                        @else
                            <p class="mb-0">Debe aceptar al voluntario para ver sus datos de contacto</p>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Redes sociales</div>
                    <div class="card-body">
                        <!-- Redes -->
                        @if ($volunteer->linkedin || $volunteer->facebook || $volunteer->instagram)
                            <ul class="list-unstyled mb-0">
                                @if ($volunteer->linkedin)
                                    <li>
                                        <a href="{{ $volunteer->linkedin }}"
                                           target="_blank">
                                            <i class="bi bi-linkedin fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->linkedin }}
                                        </a>
                                    </li>
                                @endif
                                @if ($volunteer->facebook)
                                    <li>
                                        <a href="{{ $volunteer->facebook }}"
                                           target="_blank">
                                            <i class="bi bi-facebook fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->facebook }}
                                        </a>
                                    </li>
                                @endif
                                @if ($volunteer->instagram)
                                    <li>
                                        <a href="{{ $volunteer->instagram }}"
                                           target="_blank">
                                            <i class="bi bi-instagram fs-5 me-2 text-azul align-middle"></i>
                                            {{ $volunteer->instagram }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
