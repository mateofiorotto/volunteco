<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100">
        @if ($project->image)
            <img src="{{ asset('storage/' . $project->image) }}"
                 class="card-img-top"
                 alt="{{ $project->title }}"
                 style="height: 200px; object-fit: cover;">
        @endif
        <div class="card-body d-flex flex-column">
            <h3 class="card-title h5">{{ $project->title }}</h3>
            <div class="mb-2">
                <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                <!-- si la ruta es /anfitriones/mis-proyectos -->
                @if (request()->is('anfitriones/mis-proyectos*'))
                    @if ($project->enabled == true)
                        <span class="badge bg-success">Publicado</span>
                    @else
                        <span class="badge bg-danger">No Publicado</span>
                    @endif
                @endif
                    <!--Si la ruta es /voluntarios/mis-proyectos-aplicados-->
                    @if (isset($project->pivot) && $project->pivot?->status === 'aceptado')
                        <span class="badge bg-success">Aceptado</span>
                    @elseif(isset($project->pivot) && $project->pivot?->status === 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @elseif(isset($project->pivot) && $project->pivot?->status === 'rechazado')
                        <span class="badge bg-danger">Rechazado</span>
                    @endif
            </div>

            <p class="card-text mb-3 small">
                {{ Str::limit($project->description, 100) }}
            </p>

            <ul class="list-unstyled mt-auto mb-3">
                <li class="d-flex gap-2 align-items-start mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg flex-shrink-0"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                    <span>{{ $project->host->name }}</span>
                </li>

                <li class="d-flex gap-2 align-items-start mb-2">
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
                    <span>{{ $project->location }}</span>
                </li>

                <li class="d-flex gap-2 align-items-start mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg flex-shrink-0"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span>
                        {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                        -
                        {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                    </span>
                </li>

                <li class="d-flex gap-2 align-items-start mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg flex-shrink-0"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>{{ $project->work_hours_per_day }} por día</span>
                </li>

                <li class="d-flex gap-2 align-items-start mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg flex-shrink-0"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span>{{ $project->conditions->count() }} Condiciones</span>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <!-- Si la ruta es el admin de anfitriones -->
                @if (request()->is('anfitriones/mis-proyectos*'))
                <a href="{{ route('my-projects.show', $project->id) }}"
                   class="btn btn-sm btn-outline-primary flex-grow-1">
                    Administrar Proyecto
                </a>
                @else
                <a href="{{ route('project', $project->id) }}"
                     class="btn btn-sm btn-outline-primary flex-grow-1">
                    Ver Detalles
                </a>
                @endif

                @if (isset($project->pivot) && $project->pivot?->status !== 'rechazado')
                    <form method="POST"
                          action="{{ route('withdraw-project', $project->id) }}"
                          onsubmit="return confirm('¿Estás seguro de que deseas desistir de este proyecto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                            Desistir
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
