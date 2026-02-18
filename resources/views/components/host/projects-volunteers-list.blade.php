<div id="volunteers-list">
    <div class="card p-0 border-primary">
        <div class="card-header text-bg-primary">
            <h2 class="h5 mb-0">Voluntarios <span class="fw-light">que aplicaron</span></h2>
        </div>

        @if ($registeredVolunteers->isEmpty())
        <div class="card-body">
            <p class="mb-0">No hay voluntarios inscriptos en este proyecto.</p>
        </div>
        @else
            <table class="table border-primary">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Evaluación en este proyecto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registeredVolunteers ?? [] as $volunteer)
                        <tr class="{{$volunteer->user?->status !== 'activo' ? 'table-danger' : ''}} align-middle">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                        alt="Avatar de {{ $volunteer->full_name }}"
                                        class="rounded-circle me-2"
                                        width="40"
                                        height="40">
                                    {{ $volunteer->full_name }}
                                </div>
                            </td>
                            <td>
                                @if($volunteer->user->status == 'activo')
                                    @if ($volunteer->pivot->status !== 'aceptado')
                                        <span
                                            class="text-capitalize badge {{ $volunteer->pivot->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger' }}">
                                            {{ $volunteer->pivot->status }}
                                        </span>
                                    @else
                                        <span class="text-capitalize badge text-body">
                                            {{ $volunteer->pivot->status }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-capitalize badge text-bg-danger }}">{{ $volunteer->user->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($volunteer->pivot->status == 'aceptado')
                                    @if($volunteer->is_evaluated)
                                    <div class="d-flex gap-4 align-items-center">
                                        <p class="fw-semibold mb-0">{{ $volunteer->evaluation->performance_label }}</p>
                                        <a href="{{ route('host.my-projects.evaluated-volunteer', [$project->id, $volunteer->id]) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="ver">Ver detalle</a>
                                    </div>
                                    @else
                                    <a href="{{ route('host.my-projects.evaluation-volunteer', [$project->id, $volunteer->id]) }}"
                                            class="btn btn-sm btn-warning"
                                            title="ver">Evaluar</a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    @if($volunteer->user->status == 'activo')
                                    <a href="{{ route('host.volunteers.profile', $volunteer->id) }}"
                                        class="btn btn-sm btn-azul"
                                        title="ver">Ver perfil</a>
                                    @endif
                                    @if ($volunteer->pivot->status == 'aceptado')
                                        <form method="POST"
                                                action="{{ route('host.my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger {{$volunteer->user->status !== 'activo' ? 'disabled' : ''}}" >Rechazar</button>
                                        </form>
                                    @else
                                        <form method="POST"
                                                action="{{ route('host.my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn btn-sm btn-primary {{$volunteer->user->status !== 'activo' ? 'disabled' : ''}} {{ $project->enabled == false ? 'disabled' : '' }}">Aceptar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
