<div id="volunteers-list">
    <div class="d-flex justify-content-end gap-2 p-2 ms-auto">
        <div class="text-muted small"><span class="d-inline-block rounded-circle bg-primary"
                  style="width: 10px; height: 10px;"></span> Aceptado</div>
        <div class="text-muted small"><span class="d-inline-block rounded-circle bg-warning"
                  style="width: 10px; height: 10px;"></span> Pendiente</div>
        <div class="text-muted small"><span class="d-inline-block rounded-circle bg-danger"
                  style="width: 10px; height: 10px;"></span> Rechazado</div>
    </div>

    <div class="row">
        @if ($pending->isNotEmpty())
            <div class="col-6">
                <div class="card p-0 border-warning mb-3">
                    <div class="card-header text-bg-warning">
                        <h2 class="h5 mb-0">Voluntarios <span class="fw-light">pendientes de revisión</span></h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre y apellido</th>
                                    <th scope="col"
                                        class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending ?? [] as $volunteer)
                                    <tr class="align-middle">
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                                     alt="Avatar de {{ $volunteer->full_name }}"
                                                     class="rounded-circle me-2"
                                                     width="40"
                                                     height="40">
                                                @if ($volunteer->user->status == 'activo')
                                                    <a
                                                       href="{{ route('host.volunteers.profile', $volunteer->id) }}">{{ $volunteer->full_name }}</a>
                                                @else
                                                    <span class="text-muted">{{ $volunteer->full_name }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class="text-center">
                                                    @if ($volunteer->user->status == 'activo')
                                                        <a href="{{ route('host.volunteers.profile', $volunteer->id) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="ver">Ver perfil</a>
                                                    @else
                                                        <span
                                                              class="text-capitalize badge text-bg-danger }}">{{ $volunteer->user->status }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-secondary {{ $volunteer->user->status !== 'activo' ? 'disabled' : '' }} {{ $project->enabled == false ? 'disabled' : '' }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $volunteer->id }}">
                                                        Rechazar
                                                    </button>
                                                </div>

                                                {{-- Modal --}}
                                                <div class="modal fade"
                                                     id="rejectModal{{ $volunteer->id }}"
                                                     tabindex="-1"
                                                     aria-labelledby="rejectModalLabel{{ $volunteer->id }}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST"
                                                                  action="{{ route('host.my-projects.reject-volunteer', [$project->id, $volunteer->id]) }}"
                                                                  novalidate>
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="rejectModalLabel{{ $volunteer->id }}">
                                                                        Rechazar voluntario
                                                                    </h5>
                                                                    <button type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Cerrar"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="text-muted small mb-3">
                                                                        Estás por rechazar a
                                                                        <strong>{{ $volunteer->full_name }}</strong>.
                                                                        Se le enviará un email notificando el rechazo.
                                                                    </p>
                                                                    <div class="mb-3">
                                                                        <label for="rejection_reason_{{ $volunteer->id }}"
                                                                               class="form-label">Motivo del
                                                                            rechazo:</label>
                                                                        <textarea required
                                                                                  id="rejection_reason_{{ $volunteer->id }}"
                                                                                  name="rejection_reason"
                                                                                  class="form-control"
                                                                                  rows="3"
                                                                                  placeholder="Indicá el motivo por el que se rechaza al voluntario..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Confirmar
                                                                        rechazo</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <form method="POST"
                                                          action="{{ route('host.my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary {{ $volunteer->user->status !== 'activo' ? 'disabled' : '' }} {{ $project->enabled == false ? 'disabled' : '' }}">Aceptar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($rejected->isNotEmpty())
            <div class="col-6">
                <div class="card p-0 border-danger mb-3">
                    <div class="card-header text-bg-danger">
                        <h2 class="h5 mb-0">Voluntarios <span class="fw-light">rechazados</span></h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre y apellido</th>
                                    <th scope="col"
                                        class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rejected ?? [] as $volunteer)
                                    <tr class="align-middle">
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                                     alt="Avatar de {{ $volunteer->full_name }}"
                                                     class="rounded-circle me-2"
                                                     width="40"
                                                     height="40">
                                                @if ($volunteer->user->status == 'activo')
                                                    <a
                                                       href="{{ route('host.volunteers.profile', $volunteer->id) }}">{{ $volunteer->full_name }}</a>
                                                @else
                                                    <span class="text-muted">{{ $volunteer->full_name }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class="text-center">
                                                    @if ($volunteer->user->status == 'activo')
                                                        <a href="{{ route('host.volunteers.profile', $volunteer->id) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="ver">Ver perfil</a>
                                                    @else
                                                        <span
                                                              class="text-capitalize badge text-bg-danger }}">{{ $volunteer->user->status }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <form method="POST"
                                                          action="{{ route('host.my-projects.accept-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary {{ $volunteer->user->status !== 'activo' ? 'disabled' : '' }} {{ $project->enabled == false ? 'disabled' : '' }}">Aceptar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="card p-0 border-primary">
        <div class="card-header text-bg-primary">
            <div class="d-flex justify-content-between">
                <h2 class="h5 mb-0">Voluntarios <span class="fw-light">del projecto (<span
                              class="small fw-light">Total: {{ $inProject->count() }}</span>)</span></h2>
                <p class="mb-0"><span class="small fw-light">Activos: {{ $accepted->count() }}</span>
                    {!! $finished->count() ? '| <span class="small fw-light">Finalizados: ' . $finished->count() . '</span>' : '' !!}</p>
            </div>
        </div>
        <div class="card-body">

            @if ($inProject->isEmpty())
                <p class="mb-0">No hay voluntarios inscriptos en este proyecto.</p>
            @else
                <table class="table border-primary">
                    <thead>
                        <tr>
                            <th scope="col">Nombre y apellido</th>
                            <th scope="col">Evaluación en este proyecto</th>
                            <th scope="col"
                                class="text-center"
                                width="440">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inProject ?? [] as $volunteer)
                            <tr class="align-middle">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                             alt="Avatar de {{ $volunteer->full_name }}"
                                             class="rounded-circle me-2"
                                             width="40"
                                             height="40">
                                        @if ($volunteer->user->status == 'activo')
                                            <a
                                               href="{{ route('host.volunteers.profile', $volunteer->id) }}">{{ $volunteer->full_name }}</a>
                                        @else
                                            <span class="text-muted">{{ $volunteer->full_name }}</span>
                                        @endif

                                        @if ($volunteer->user->status == 'activo')
                                            <a href="{{ route('host.volunteers.profile', $volunteer->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="ver">Ver perfil</a>
                                        @else
                                            <span
                                                  class="text-capitalize badge text-bg-danger }}">{{ $volunteer->user->status }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if ($volunteer->pivot->isCanceled() || $volunteer->pivot->isCompleted())
                                        @if ($volunteer->is_evaluated)
                                            <div class="d-flex gap-4 align-items-center">
                                                <p class="mb-0">Nivel: <span
                                                          class="text-muted small">{{ $volunteer->evaluation->performance_label }}
                                                        ({{ $volunteer->evaluation->average_score }})
                                                    </span></p>
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
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-6 text-center">
                                            @if ($volunteer->pivot->isCanceled())
                                                <span class="badge text-bg-danger">
                                                    Cancelado
                                                </span>
                                            @else
                                                @if (!$volunteer->pivot->isCompleted())
                                                    <form method="POST"
                                                          action="{{ route('host.my-projects.cancel-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger {{ $volunteer->user->status !== 'activo' ? 'disabled' : '' }} {{ $project->enabled == false ? 'disabled' : '' }}">Cancelar
                                                            voluntariado</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-6 text-center">
                                            @if ($volunteer->pivot->isCompleted())
                                                <span class="badge text-bg-success">
                                                    Completado
                                                </span>
                                            @else
                                                @if (!$volunteer->pivot->isCanceled())
                                                    <form method="POST"
                                                          action="{{ route('host.my-projects.complete-volunteer', [$project->id, $volunteer->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-azul {{ $volunteer->user->status !== 'activo' ? 'disabled' : '' }} {{ $project->enabled == false ? 'disabled' : '' }}">Completó
                                                            el voluntariado</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@section('scripts')
    <script>
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')

        if (toastTrigger) {
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastTrigger.addEventListener('click', () => {
                toastBootstrap.show()
            })
        }
    </script>
@endsection
