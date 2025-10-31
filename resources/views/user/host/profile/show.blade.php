@extends('layouts.app')

@section('content')
    <section class="container py-5">

        <!-- Perfil -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4 p-md-5">
                <div class="row">
                    <!-- Foto de perfil -->
                    <aside class="col-lg-3 col-md-4 mb-4 mb-md-0 text-center">
                        <figure class="position-relative d-inline-block mb-0">
                            <img src="{{ asset('storage/' . $host->avatar) }}"
                                 alt="Foto de perfil de {{ $host->name }}"
                                 class="rounded-circle img-fluid shadow object-fit-cover avatar-lg">
                        </figure>

                        <!-- Redes -->
                        @if ($host->linkedin || $host->facebook || $host->instagram)
                            <nav class="d-flex justify-content-center gap-2 mt-4"
                                 aria-label="Redes sociales">
                                @if ($host->linkedin)
                                    <a href="{{ $host->linkedin }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center social-icon p-2"
                                       aria-label="Perfil de LinkedIn">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="currentColor"
                                             width="24"
                                             height="24"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($host->facebook)
                                    <a href="{{ $host->facebook }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center social-icon p-2"
                                       aria-label="Perfil de Facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="currentColor"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($host->instagram)
                                    <a href="{{ $host->instagram }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center social-icon p-2"
                                       aria-label="Perfil de Instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="currentColor"
                                             viewBox="0 0 16 16"
                                             aria-hidden="true">
                                            <path
                                                  d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                        </svg>
                                    </a>
                                @endif
                            </nav>
                        @endif
                    </aside>

                    <!-- Info (nombre, editar (si el perfil es propio), localidad) -->
                    <div class="col-lg-9 col-md-8">
                        <div class="mb-4">
                            <div class="row mb-4">
                                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                    <h1 class="h3 fw-bold mb-1">{{ $host->name }}</h1>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if (Auth::id() == $host->user_id)
                                            <a href="{{ route('hosts.update-my-profile') }}"
                                               class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     width="20"
                                                     height="20"
                                                     class="d-inline">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                                Editar perfil
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        @if ($host->location)
                            <div class="row g-4 mb-4">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-3"
                                             aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor"
                                                 width="24"
                                                 height="24"
                                                 class="text-primary">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                        </div>
                                        <dl>
                                            <dt class="text-muted small mb-1">Ubicación</dt>
                                            <dd class="mb-0 fw-medium">{{ $host->location }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Descripción -->
                        <div class="mt-4">
                            <h2 class="h5 fw-bold mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor"
                                     width="20"
                                     height="20"
                                     class="d-inline text-primary"
                                     aria-hidden="true">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                Descripción
                            </h2>
                            <p class="text-muted mb-0">
                                {{ $host->description }}
                            </p>
                        </div>
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
                                 class="text-primary">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <p class="h5 fw-bold mb-1">{{ $host->created_at->diffForHumans() }}</p>
                        <!-- convertir la fecha a "hace x tiempo" -->
                        <p class="text-muted small mb-0">Miembro desde</p>
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
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                        </div>
                        <p class="h5 fw-bold mb-1">{{ $host->projects()->count() }}</p>
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
    </section>
@endsection