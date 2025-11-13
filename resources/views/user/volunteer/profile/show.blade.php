@extends('layouts.app')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            @if (Auth::id() == $volunteer->user_id)
                <h1 class="title-h1 h3">Mi <span>Perfil</span></h1>
                <a href="{{ route('volunteer.update-my-profile') }}" class="btn btn-primary">Editar Perfil</a>
            @else
                <h1 class="title-h1 h3">Perfil del Voluntario</h1>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Perfecto!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Perfil -->
        <div class="row">
            <div class="col-md-7">
                <div class="card border mb-4">
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-start">
                            <!-- Foto de perfil -->
                            <div>
                                <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg'))}}" alt="Foto de perfil de {{ $volunteer->full_name }}" class="rounded-circle object-fit-cover avatar-lg" width="200" height="200">
                            </div>

                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $volunteer->full_name }}</h2>
                                <!-- Info Grid -->
                                @if ($volunteer->location_id)
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <p>{{ $volunteer->location->name }} - {{ $volunteer->location->province->name }}</p>
                                    </div>
                                @endif
                                @if ($volunteer->dni)
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-person-vcard text-primary me-2"></i>
                                        <p>{{ number_format($volunteer->dni, 0, ',', '.') }}</p>
                                    </div>
                                @endif
                                @if ($volunteer->birthdate)
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-cake text-primary me-2"></i>
                                        <p>{{ $volunteer->birthdate->format('d/m/Y') }}</p>
                                    </div>
                                @endif
                                <!-- Descripción -->
                                <div>
                                    <h3 class="card-title h5">Biografía</h3>
                                    <p class="text-muted mb-0">{{ $volunteer->biography }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h3 class="card-title h5">Datos de Contacto</h3>
                            <ul class="list-unstyled">
                                <li><span class="text-muted small">Teléfono: </span>{{ $volunteer->phone }}</li>
                                <li><span class="text-muted small">Email: </span>{{ $volunteer->user->email }}</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h3 class="card-title h5">Datos de Profesionales</h3>
                            <ul class="list-unstyled">
                                <li><span class="text-muted small">Profesión: </span><span
                                          class="text-capitalize">{{ $volunteer->profession }}</span></li>
                                <li><span class="text-muted small">Nivel educativo: </span><span
                                          class="text-capitalize">{{ $volunteer->educational_level }}</span></li>
                            </ul>
                        </div>

                        <!-- Redes -->
                        @if ($volunteer->linkedin || $volunteer->facebook || $volunteer->instagram)
                            <h3 class="card-title h5">Redes sociales</h3>
                            <div class="d-flex gap-3">
                                @if ($volunteer->linkedin)
                                    <a href="{{ $volunteer->linkedin }}"
                                       target="_blank"
                                       class="fs-5 text-primary">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                @endif
                                @if ($volunteer->facebook)
                                    <a href="{{ $volunteer->facebook }}"
                                       target="_blank"
                                       class="fs-5 text-primary">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if ($volunteer->instagram)
                                    <a href="{{ $volunteer->instagram }}"
                                       target="_blank"
                                       class="fs-5 text-primary">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- estadisticas -->
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 stat-icon"
                             aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 width="30"
                                 height="30"
                                 class="text-success">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <p class="h5 fw-bold mb-1">x</p>
                        <p class="text-muted small mb-0">Proyectos completados</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 stat-icon"
                             aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 width="30"
                                 height="30"
                                 class="text-success">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                        </div>
                        <p class="h5 fw-bold mb-1">x</p>
                        <p class="text-muted small mb-0">Nivel</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
