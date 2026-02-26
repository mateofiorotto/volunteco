@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3">Mi <span>perfil</span></h1>
            <a href="{{ route('volunteer.my-profile.edit') }}"
               class="btn btn-primary">Editar perfil</a>
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
                                    @if ($volunteer->dni)
                                        <li>DNI: <span class="text-muted small">{{ number_format($volunteer->dni, 0, ',', '.') }}</span></li>
                                    @endif
                                    @if ($volunteer->birthdate)
                                        <li>Fecha de nacimiento: <span class="text-muted small">{{ $volunteer->birthdate->format('d/m/Y') }}</span></li>
                                    @endif
                                </ul>
                                <ul class="list-unstyled mb-0">
                                    <li>Profesión: <span
                                            class="text-capitalize small text-muted">{{ $volunteer->profession }}</span></li>
                                    <li>Nivel educativo: <span
                                            class="text-capitalize small text-muted">{{ $volunteer->educational_level }}</span></li>
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
                        <ul class="list-unstyled mb-0">
                            <li>Teléfono: <span class="text-muted small">{{ $volunteer->phone }}</span></li>
                            <li>Email: <span class="text-muted small">{{ $volunteer->user->email }}</span></li>
                        </ul>
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
                        @else
                            <p class="mb-0">No tiene cargada ninguna red social</p>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Insignias</div>
                    <div class="card-body">
                        @if($volunteer->evaluations->isNotEmpty())
                        <p>Nivel: <span class="small text-muted">{{$volunteer->global_performance_label}}</span></p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
