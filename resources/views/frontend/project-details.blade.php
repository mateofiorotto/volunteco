@extends('layouts.app')

@section('content')
    <section class="container text-break pt-5 pb-5">
        <div class="row">

            <h2>Detalles del proyecto</h2>

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
                            <h3 class="card-title">Información del anfitrión</h3>

                            <!-- NOTA: esto ira al perfil del anfitrion una vez tengamos perfiles publicos -->
                            <a href="#"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    @if ($project->host->avatar)
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $project->host->avatar) }}"
                                                 class="rounded-circle"
                                                 alt="Foto de {{ $project->host->name }}"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <p class="text-dark fw-semibold">{{ $project->host->name }}</p>
                                    </div>
                                </div>
                            </a>

                            @if ($project->host->location)
                                <div class="mb-2 d-flex gap-2 align-items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="icon-svg flex-shrink-0"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <p>{{ $project->host->location }}</p>
                                </div>
                            @endif

                            <div class="d-flex gap-2">
                                @if ($project->host->linkedin)
                                    <a href="{{ $project->host->linkedin }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm"
                                       aria-label="LinkedIn de {{ $project->host->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="currentColor"
                                             class="bi bi-linkedin icon-svg"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($project->host->instagram)
                                    <a href="{{ $project->host->instagram }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm"
                                       aria-label="Instagram de {{ $project->host->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="currentColor"
                                             class="bi bi-instagram icon-svg"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($project->host->facebook)
                                    <a href="{{ $project->host->facebook }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm"
                                       aria-label="Facebook de {{ $project->host->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="currentColor"
                                             class="bi bi-facebook icon-svg"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Botones de acción para voluntarios --}}
                    @if (Auth::check() && Auth::user()->hasRole('volunteer'))
                        <div class="card mt-3">
                            <div class="card-body">
                                @if ($hasApplied)
                                    @php
                                        $application = Auth::user()
                                            ->volunteer->projects()
                                            ->where('project_id', $project->id)
                                            ->first();
                                        $status = $application ? $application->pivot->status : null;
                                    @endphp

                                    @if ($status === 'pendiente')
                                        <div class="alert alert-info mb-3">
                                            <strong>Solicitud Pendiente</strong><br>
                                            Tu solicitud está siendo revisada por el anfitrión.
                                        </div>
                                    @elseif($status === 'aceptado')
                                        <div class="alert alert-success mb-3">
                                            <strong>Solicitud Aceptada</strong><br>
                                            ¡Felicitaciones! Has sido aceptado en este proyecto.
                                        </div>
                                    @elseif($status === 'rechazado')
                                        <div class="alert alert-danger mb-3">
                                            <strong>Solicitud Rechazada</strong><br>
                                            Lamentablemente tu solicitud no fue aceptada para este proyecto.
                                        </div>
                                    @endif

                                    @if ($status !== 'rechazado')
                                        <form method="POST"
                                              action="{{ route('withdraw-project', $project->id) }}"
                                              onsubmit="return confirm('¿Estás seguro de que deseas desistir de este proyecto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"
                                                    type="submit">
                                                Desistir del proyecto
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <p class="mb-3">¿Te interesa participar en este proyecto?</p>
                                    <form method="POST"
                                          action="{{ route('apply-project', $project->id) }}">
                                        @csrf
                                        <button class="btn btn-primary"
                                                type="submit">
                                            Aplicar al proyecto
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </section>
@endsection
