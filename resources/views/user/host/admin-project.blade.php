@extends('layouts.app')

@section('content')
    <section class="container text-break pt-5 pb-5">
        <div class="row">

            <h2>Proyecto</h2>

            <!-- Alerta de exito temporal -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Alerta de error temporal mas adelante cambiar por swal2 o algo mas lindo -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    {{ session('error') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Detalles del proyecto -->
                <div class="col-lg-8 col-12 card mb-4">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}"
                             class="card-img-top"
                             alt="{{ $project->title }}"
                             style="max-height: 400px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $project->title }}</h3>

                        <p class="card-text">{{ $project->description }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0 text-primary"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Ubicación</h4>
                                        <p class="mb-0">{{ $project->location }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0 text-primary"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Horas por día</h4>
                                        <p class="mb-0">{{ $project->work_hours_per_day }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0 text-primary"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Fecha de inicio</h4>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex gap-2 align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0 text-primary"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    <div>
                                        <h4 class="h6 fw-semibold mb-1">Fecha de finalización</h4>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($project->conditions->isNotEmpty())
                            <div class="mt-4">
                                <div class="d-flex gap-2 align-items-start mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0 text-primary"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>
                                    <h4 class="h6 fw-semibold mb-0">Condiciones y Requisitos</h4>
                                </div>
                                <ul class="list-unstyled ms-4">
                                    @foreach ($project->conditions as $condition)
                                        <li class="mb-2 d-flex gap-2 align-items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor"
                                                 class="icon-svg flex-shrink-0 text-success"
                                                 style="width: 18px; height: 18px; margin-top: 2px;"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                            <span>{{ $condition->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Acciones</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET"
                                        action="{{ route('my-projects.edit', $project->id) }}">
                                        @csrf
                                        <button class="btn btn-primary w-100 mb-3"
                                                type="submit">
                                            Editar
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form method="GET"
                                        action="{{ route('my-projects.delete', $project->id) }}">
                                        @csrf
                                        <button class="btn btn-outline-primary w-100 mb-3"
                                                type="submit">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <a href="#volunteers-list">
                                        <button class="btn btn-secondary text-light w-100 mb-3"
                                                type="submit">
                                            Ver Voluntarios que aplicaron
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="volunteers-list"
                 class="row mt-5">
                <h3>Voluntarios inscritos</h3>

                {{-- Voluntarios ACEPTADOS --}}
                @if ($registeredVolunteers->where('pivot.status', 'aceptado')->isNotEmpty())
                    <h4 class="mt-4 mb-3">Voluntarios Aceptados</h4>
                    @foreach ($registeredVolunteers->where('pivot.status', 'aceptado') as $volunteer)
                        <div class="card mb-3 w-100 shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                    <p class="card-text text-muted mb-0">
                                        Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Voluntarios PENDIENTES --}}
                @if ($registeredVolunteers->where('pivot.status', 'pendiente')->isNotEmpty())
                    <h4 class="mt-4 mb-3">Voluntarios Pendientes</h4>
                    @foreach ($registeredVolunteers->where('pivot.status', 'pendiente') as $volunteer)
                        <div class="card mb-3 w-100 shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                    <p class="card-text mb-0">
                                        Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong>
                                    </p>
                                     <a href="#" class="btn btn-secondary mt-3 text-light">Ver Perfil</a> <!-- Cuando esten implementados los perfiles por id -->
                                </div>

                                <div class="d-flex gap-2">
                                    <form method="POST"
                                          action="{{ route('my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="btn btn-outline-primary">Rechazar</button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="btn btn-primary">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Voluntarios RECHAZADOS --}}
                @if ($registeredVolunteers->where('pivot.status', 'rechazado')->isNotEmpty())
                    <h4 class="mt-4 mb-3">Voluntarios Rechazados</h4>
                    @foreach ($registeredVolunteers->where('pivot.status', 'rechazado') as $volunteer)
                        <div class="card mb-3 w-100 shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1">{{ $volunteer->full_name }}</h5>
                                    <p class="card-text text-muted mb-0">
                                        Estado: <strong>{{ ucfirst($volunteer->pivot->status) }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Si no hay ninguno --}}
                @if ($registeredVolunteers->isEmpty())
                    <p>No hay voluntarios inscritos en este proyecto.</p>
                @endif
    </section>
@endsection
