<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100">
        @if ($project->image)
            <img src="{{ asset('storage/' . $project->image) }}"
                 class="card-img-top"
                 alt="{{ $project->title }}"
                 style="height: 200px; object-fit: cover;">
        @endif
        <div class="card-body d-flex flex-column">
            <h3 class="card-title">{{ $project->title }}</h3>
            <div class="mb-2">
                <span class="badge bg-primary">{{ $project->projectType->name }}</span>

                <!--Si la ruta es /voluntarios/mis-proyectos-aplicados-->
                @if (isset($project->pivot) && $project->pivot?->status === 'Aceptado')
                    <span class="badge bg-success">✅ Aceptado</span>
                @elseif(isset($project->pivot) && $project->pivot?->status === 'Pendiente')
                    <span class="badge bg-warning text-dark">⏳ Pendiente</span>
                @elseif(isset($project->pivot) && $project->pivot?->status === 'Rechazado')
                    <span class="badge bg-danger">❌ Rechazado</span>
                @endif
            </div>

            <p class="card-text text-muted small">
                {{ Str::limit($project->description, 100) }}
            </p>

            <ul class="mt-auto">
                <li class="d-flex flex-row gap-2 mb-2 mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>

                    {{ $project->host->name }}
                </li>
                <li class="d-flex flex-row gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    {{ $project->location }}
                </li>

                <li class="d-flex flex-row gap-2 mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                    -
                    {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                </li>
                <li class="d-flex flex-row gap-2 mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ $project->work_hours_per_day }} horas/día
                </li>
                <li class="d-flex flex-row gap-2 mt-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="icon-svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    {{ $project->conditions->count() }} Condiciones
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a href="{{ route('project', $project->id) }}"
                   class="btn btn-sm btn-outline-primary flex-grow-1">
                    Ver Detalles
                </a>

                @if (isset($project->pivot) && $project->pivot?->status !== 'Rechazado')
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
