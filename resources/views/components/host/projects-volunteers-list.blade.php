<div class="d-flex justify-content-end gap-2 p-2">
    <div class="text-muted small"><span class="d-inline-block rounded-circle border-1 border border-primary" style="width: 10px; height: 10px;"></span> Aceptado</div>
    <div class="text-muted small"><span class="d-inline-block rounded-circle bg-warning" style="width: 10px; height: 10px;"></span> Pendiente</div>
    <div class="text-muted small"><span class="d-inline-block rounded-circle bg-danger" style="width: 10px; height: 10px;"></span> Rechazado</div>
</div>
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
                        <th scope="col">Evaluación en este proyecto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registeredVolunteers ?? [] as $volunteer)

                        <tr @class([
                                'table-warning' => $volunteer->pivot->status === 'pendiente',
                                'table-danger'  => $volunteer->pivot->status === 'rechazado',
                            ]) class="align-middle">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                        alt="Avatar de {{ $volunteer->full_name }}"
                                        class="rounded-circle me-2"
                                        width="40"
                                        height="40">
                                        <a href="{{ route('host.volunteers.profile', $volunteer->id) }}">{{ $volunteer->full_name }}</a>
                                </div>
                            </td>
                            <td>
                                @if ($volunteer->pivot->status == 'aceptado')
                                    @if($volunteer->is_evaluated)
                                    <div class="d-flex gap-4 align-items-center">
                                        <p class="mb-0"><span>{{ $volunteer->evaluation->average_score }} - {{ $volunteer->evaluation->performance_label }}</span></p>
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
                            <td class="align-middle">
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
