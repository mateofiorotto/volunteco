@extends('layouts.app')

@section('content')
    <section class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="title-h1 h3">Mi <span>Perfil</span></h1>
            @if (Auth::id() == $host->user_id)
                <a href="{{ route('hosts.update-my-profile') }}"
                   class="btn btn-primary">
                    Editar Perfil
                </a>
            @endif
        </div>

        <!-- Perfil -->
        <div class="row">
            <div class="col-md-7">
                <div class="card border mb-4">
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-start">
                            <!-- Foto de perfil -->
                            <div>
                                <img src="{{ asset('storage/' . $host->avatar) }}"
                                     alt="Foto de perfil de {{ $host->name }}"
                                     class="rounded-circle object-fit-cover avatar-lg"
                                     width="200"
                                     height="200">
                            </div>

                            <!-- Info (nombre, editar (si el perfil es propio), localidad) -->
                            <div class="flex-fill">
                                <h2 class="card-title h3">{{ $host->name }}</h2>
                                <!-- Info Grid -->
                                @if ($host->location)
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <p>{{ $host->location }}</p>
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
            </div>
            <div class="col-md-5">
                <div class="card border mb-4">
                    <div class="card-body">
                        <h3 class="card-title h3">Contacto</h3>
                        <ul class="list-unstyled">
                            <li><span class="text-muted small">Persona de contacto: </span>{{ $host->person_full_name }}
                            </li>
                            <li><span class="text-muted small">Teléfono: </span>{{ $host->phone }}</li>
                            <li><span class="text-muted small">Email: </span>{{ $host->user->email }}</li>
                        </ul>

                        <!-- Redes -->
                        @if ($host->linkedin || $host->facebook || $host->instagram)
                            <h3 class="card-title h5">Redes sociales</h3>
                            <div class="d-flex gap-3">
                                @if ($host->linkedin)
                                    <a href="{{ $host->linkedin }}"
                                       target="_blank"
                                       class="fs-5 text-primary">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                @endif
                                @if ($host->facebook)
                                    <a href="{{ $host->facebook }}"
                                       target="_blank"
                                       class="fs-5 text-primary">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if ($host->instagram)
                                    <a href="{{ $host->instagram }}"
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


        <!-- estadísticas -->
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
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                        </div>
                        <p class="h5 fw-bold mb-1">{{ $host->projects()->where('enabled', true)->count() }}</p> <!-- contamos solo proyectos habilitados -->
                        <p class="text-muted small mb-0">Proyectos publicados</p>
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
        @if ($projects->isNotEmpty())
            <div class="mb-5 mt-5">
                <h2 class="text-center title-h1 h3 mb-5">Proyectos de <span>{{ $host->name }}</span></h2>
                <x-project-grid :projects="$projects" />
            </div>
            @if($projects->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $projects->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center">
                <p class="mb-0">Este anfitrión aún no tiene proyectos publicados.</p>
            </div>
        @endif
    </section>
@endsection
