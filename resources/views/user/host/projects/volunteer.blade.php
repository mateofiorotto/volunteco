@extends('layouts.admin')

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="title-h1 h3 mb-0">Evaluación del <span>voluntario</span></h1>
            <p>Tu evaluación ayuda a reconocer el trabajo del voluntario, su compromiso y sus fortalezas; y a mejorar futuras experiencias.</p>
        </div>
        <a href="{{ route('host.my-projects.show', $project) }}"
            class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
    </div>

    {{-- Alerta de errores general --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-inline-block"
                role="alert">
            <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show"
                role="alert">
            <strong>¡Perfecto!</strong> {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <form id="evaluationForm" action="{{ route('host.my-projects.evaluate-volunteer', [$project, $volunteer]) }}" method="POST" novalidate>
                @csrf

                <div class="card">
                    <div class="card-body">

                        <h2 class="card-title h4 mb-3">¿Cómo dirías que fue el desempeño de <span class="fw-bold">{{ $volunteer->full_name }}</span> en "{{ $project->title }}"?</h2>
                        <p class="fw-semibold text-secondary">Esta evaluación se realiza por única vez. Una vez enviada no se pueden modificar.</p>
                        <div class="mb-3">
                            <!-- Actitud -->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <div class="form-label mb-md-0">
                                        <span>Actitud y motivación *</span><br>
                                        <span class="text-primary xs-small lh-sm d-inline-block">Evalúa su entusiasmo por ayudar y capacidad de trabajo en equipo.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex gap-3">
                                        @foreach ($levels as $value => $label)
                                        <div class="form-check form-check-inline me-0">
                                            <input
                                                class="form-check-input @error('attitude_score') is-invalid @enderror"
                                                type="radio"
                                                name="attitude_score"
                                                id="attitude_score_{{ $loop->index }}"
                                                value="{{ $value }}"
                                                @checked(old('attitude_score') == $value)
                                                >
                                            <label class="form-check-label text-muted" for="attitude_score_{{ $loop->index }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('attitude_score')<div class="invalid-feedback d-inline-block">{{$message}}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- Habilidades -->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <div class="form-label mb-md-0">
                                        <span>Habilidades técnicas *</span><br>
                                        <span class="text-primary xs-small lh-sm d-inline-block">Evalúa la efectividad de sus habilidades técnicas o la disposición a aprender.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex gap-3">
                                        @foreach ($levels as $value => $label)
                                        <div class="form-check form-check-inline me-0">
                                            <input
                                                class="form-check-input @error('skills_score') is-invalid @enderror"
                                                type="radio"
                                                name="skills_score"
                                                id="skills_score_{{ $loop->index }}"
                                                value="{{ $value }}"
                                                @checked(old('skills_score') == $value)>
                                            <label class="form-check-label text-muted" for="skills_score_{{ $loop->index }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('skills_score')<div class="invalid-feedback d-inline-block">{{$message}}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- Responsabilidad -->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">
                                        <span class="d-inline-block text-nowrap">Responsabilidad y compromiso *</span><br>
                                        <span class="text-primary xs-small lh-sm d-inline-block">Evalúa su compromiso y respeto por el proyecto y su entorno.</span>
                                    </label>
                                </div>
                                <div class="col">
                                    <div class="d-flex gap-3">
                                        @foreach ($levels as $value => $label)
                                        <div class="form-check form-check-inline me-0">
                                            <input
                                                class="form-check-input @error('responsibility_score') is-invalid @enderror"
                                                type="radio"
                                                name="responsibility_score"
                                                id="responsibility_score_{{ $loop->index }}"
                                                value="{{ $value }}"
                                                @checked(old('responsibility_score') == $value)>
                                            <label class="form-check-label text-muted" for="responsibility_score_{{ $loop->index }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('responsibility_score')<div class="invalid-feedback d-inline-block">{{$message}}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Fortalezas -->
                            <div class="form-group">
                                <label for="strengths" class="form-label lh-sm">Fortalezas destacadas<br><span class="form-text xs-small text-primary">Sé breve en tu comentario y recuerda que es un reconocimiento a su desempeño.</span></label>
                                <textarea name="strengths" id="strengths" class="form-control @error('strengths') is-invalid @enderror" rows="2" placeholder="Ej: Muy responsable, buena comunicación" required></textarea>
                                @error('strengths')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- Aspectos a mejorar -->
                            <div class="form-group">
                                <label for="improvements" class="form-label lh-sm">Aspectos a mejorar<br><span class="form-text xs-small text-primary">Sé breve en tu comentario y recuerda que es para mejorar futuras experiencias.</span></label>
                                <textarea name="improvements" id="improvements" class="form-control @error('improvements') is-invalid @enderror" rows="2" placeholder="Ej: Puede mejorar habilidades técnicas"></textarea>
                                @error('improvements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center mt-4 mb-5">
                    <!-- Campos ocultos -->
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <input type="hidden" name="volunteer_id" value="{{ $volunteer->id }}">

                    <a href="{{ route('host.my-projects.show', $project->id) }}" class="btn btn-outline-primary btn-lg px-5">
                        Cancelar
                    </a>

                    <button type="button" class="btn btn-primary btn-lg px-5" data-bs-toggle="modal" data-bs-target="#evaluacionModal">
                        Enviar evaluación
                    </button>

                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center mb-2">
                        @if($volunteer->avatar)
                        <div class="avatar">
                            <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                        alt="Foto de perfil de {{ $volunteer->name }}"
                                        class="rounded-circle object-fit-contain avatar"
                                        width="80"
                                        height="80" />
                        </div>
                        @endif
                        <div class="flex-fill">
                            <h3 class="card-title h4 mb-0">{{ $volunteer->full_name }}</h3>
                            <!-- Info Grid -->
                            <ul class="list-unstyled mb-0">
                                @if ($volunteer->birthdate)
                                    <li class="text-muted">{{ $volunteer->birthdate->age }} años</li>
                                @endif
                                <li class="text-capitalize text-muted">{{ $volunteer->profession }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h3 class="card-title h5 mb-0">{{ $project->title }}</h3>
                        @if ($project->enabled === 0)
                            <span class="badge text-bg-danger">
                                Deshabilitado
                            </span>
                        @endif
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="text-muted">{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</li>
                        <li class="text-muted">{{ $project->location->name }} - {{ $project->location->province->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modals')
    <div class="modal fade" id="evaluacionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5">Enviar evaluación</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de enviar esta evaluación?<br>Recuerda que una vez enviada <span class="fw-bold">no podrás modificarla</span>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No</button>

                    <button type="button" class="btn btn-primary" id="confirmSubmit">Sí, enviar</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Cierro el modal manualmente cuando envio el form
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            const modalEl = document.getElementById('evaluationForm').submit();
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
        });
    </script>
@endsection

