@php
    $modalId = 'desistirModal-' . $project->id;
    $formId = 'withdrawForm-' . $project->id;
@endphp

<div class="card mt-3">
    <div class="card-body">
        @if (Auth::check() && Auth::user()->hasRole('volunteer'))
        @if ($volunteerStatus)
            @if ($volunteerStatus === 'pendiente')
                <div class="alert alert-warning mb-3">
                    <strong>Solicitud Pendiente</strong><br>
                    Tu solicitud está siendo revisada por el anfitrión.
                </div>
            @elseif($volunteerStatus === 'aceptado')
                <div class="alert alert-success mb-3">
                    <strong>Solicitud Aceptada</strong><br>
                    ¡Felicitaciones! Has sido aceptado en este proyecto.
                </div>
            @elseif($volunteerStatus === 'rechazado')
                <div class="alert alert-danger mb-0">
                    <strong>Solicitud Rechazada</strong><br>
                    Lamentablemente tu solicitud no fue aceptada para este proyecto.
                </div>
            @endif

            @if ($volunteerStatus !== 'rechazado')
                <button type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#{{ $modalId }}">
                    Desistir del proyecto
                </button>

                <div class="modal fade"
                    id="{{ $modalId }}"
                    tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title h5">Desistir del proyecto</h2>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea cancelar su aplicación a este proyecto?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-outline-primary"
                                        data-bs-dismiss="modal">No</button>
                                <form method="POST"
                                    id="{{ $formId }}"
                                    action="{{ route('volunteer.withdraw-project', $project->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                            type="submit">Sí, cancelo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <p class="mb-3">¿Te interesa participar en este proyecto?</p>
            <form method="POST"
                    action="{{ route('volunteer.apply-project', $project->id) }}">
                @csrf
                <button class="btn btn-primary" type="submit">Aplicar al proyecto</button>
            </form>
        @endif
        @else
        <p class="mb-3">¿Te interesa participar en este proyecto?</p>
        <a href="{{route('login')}}" class="btn btn-primary">Ingresá como voluntario</a>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        // Cierro el modal manualmente cuando envio el form
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('{{ $formId }}');
            const modalEl = document.getElementById('{{ $modalId }}');
            if (form && modalEl) {
                form.addEventListener('submit', function () {
                    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modalInstance.hide();
                });
            }
        });
    </script>
@endpush
