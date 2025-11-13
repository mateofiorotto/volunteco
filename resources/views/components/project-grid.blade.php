<div class="row justify-content-center">
    @foreach ($projects as $project)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card">
            @if ($project->image)
            <div class="ratio ratio-4x3">
                <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="304" height="228">
            </div>
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
                            <span class="badge bg-danger">En borrador</span>
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
                        <i class="bi bi-diagram-3 fs-5 text-primary"></i>
                        <span>{{ $project->host->name }}</span>
                    </li>

                    <li class="d-flex gap-2 align-items-start mb-2">
                        <i class="bi bi-geo-alt fs-5 text-primary"></i>
                        <span>{{ $project->location }}</span>
                    </li>

                    <li class="d-flex gap-2 align-items-start mb-2">
                        <i class="bi bi-calendar4 fs-5 text-primary"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                        </span>
                    </li>

                    <li class="d-flex gap-2 align-items-start mb-2">
                        <i class="bi-clock fs-5 text-primary"></i>
                        <span>{{ $project->work_hours_per_day }} por día</span>
                    </li>

                    <li class="d-flex gap-2 align-items-start mb-2">
                        <i class="bi bi-clipboard2-check fs-5 text-primary"></i>
                        <span>{{ $project->conditions->count() }} Condiciones</span>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <!-- Si la ruta es el admin de anfitriones -->
                    @if (request()->is('anfitriones/mis-proyectos*'))
                    <a href="{{ route('host.my-projects.show', $project->id) }}" class="btn btn-sm btn-outline-primary">
                        Ver Proyecto
                    </a>
                    @else
                    <a href="{{ route('project', $project->id) }}" class="btn btn-sm btn-outline-primary">
                        Ver Detalles
                    </a>
                    @endif

                    @if (isset($project->pivot) && $project->pivot?->status !== 'rechazado')
                        <form method="POST"
                                action="{{ route('volunteer.withdraw-project', $project->id) }}"
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
    @endforeach
</div>
