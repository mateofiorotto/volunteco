@extends('layouts.app')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3">Mi <span>Perfil</span></h1>
            @if (Auth::id() == $host->user_id)
                <a href="{{ route('host.my-profile.edit', $host->user_id) }}"
                   class="btn btn-primary">
                    Editar Perfil
                </a>
            @endif
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
                                <img src="{{ asset('storage/' . ($host->avatar ?? 'perfil-host.svg')) }}" alt="Foto de perfil de {{ $host->name }}" class="rounded-circle object-fit-contain avatar-lg" width="200" height="200"/>
                            </div>

                            <!-- Info (nombre, editar (si el perfil es propio), localidad) -->
                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $host->name }}</h2>
                                <!-- Info Grid -->
                                @if ($host->location_id)
                                    <div class="d-flex align-items-start">
                                        <p>{{ $host->location->name }} - {{ $host->location->province->name }}</p>
                                    </div>
                                @endif

                                <!-- Descripción -->
                                <div>
                                    <h3 class="card-title h5">Descripción</h3>
                                    <p class="text-muted mb-0">{{ $host->description }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Redes -->
                        @if ($host->linkedin || $host->facebook || $host->instagram)
                            <h3 class="card-title h3">Redes sociales</h3>
                            <ul class="list-unstyled">
                                @if ($host->linkedin)
                                <li>
                                    <a href="{{ $host->linkedin }}" target="_blank" class="fs-5 text-primary">
                                        <i class="bi bi-linkedin"></i>
                                        {{$host->linkedin}}
                                    </a>
                                </li>
                                @endif
                                @if ($host->facebook)
                                <li>
                                    <a href="{{ $host->facebook }}" target="_blank" class="fs-5 text-primary">
                                        <i class="bi bi-facebook"></i>
                                        {{ $host->facebook }}
                                    </a>
                                </li>
                                @endif
                                @if ($host->instagram)
                                <li>
                                    <a href="{{ $host->instagram }}" target="_blank" class="fs-5 text-primary">
                                        <i class="bi bi-instagram"></i>
                                        {{ $host->instagram }}
                                    </a>
                                </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title h3">Contacto</h3>
                        <ul class="list-unstyled">
                            <li><span class="text-muted small">Persona de contacto: </span>{{ $host->person_full_name }}
                            </li>
                            <li><span class="text-muted small">Teléfono: </span>{{ $host->phone }}</li>
                            <li><span class="text-muted small">Email: </span>{{ $host->user->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
