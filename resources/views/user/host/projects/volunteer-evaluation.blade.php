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

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h4 mb-3">Tu evaluación sobre el desempeño de <span class="fw-bold">{{ $volunteer->full_name }}</span> en "{{ $project->title }}"</h2>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <div class="form-label mb-md-0">
                                <span>Actitud y motivación</span><br>
                                <span class="text-primary xs-small lh-sm d-inline-block">Evaluación sobre su entusiasmo por ayudar y capacidad de trabajo en equipo.</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex gap-3">
                                @foreach ($levels as $value => $label)
                                <div class="badge rounded-pill {{ $evaluation->attitude_score == $value ? 'text-bg-primary' : 'text-muted' }}">{{ $label }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <div class="form-label mb-md-0">
                                <span>Habilidades técnicas</span><br>
                                <span class="text-primary xs-small lh-sm d-inline-block">Evaluación sobre la efectividad de sus habilidades técnicas o la disposición a aprender.</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex gap-3">
                                @foreach ($levels as $value => $label)
                                <div class="badge rounded-pill {{ $evaluation->skills_score == $value ? 'text-bg-primary' : 'text-muted' }}">{{ $label }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <div class="form-label mb-md-0">
                                <span>Responsabilidad y compromiso</span><br>
                                <span class="text-primary xs-small lh-sm d-inline-block">Evaluación sobre su compromiso y respeto por el proyecto y su entorno.</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex gap-3">
                                @foreach ($levels as $value => $label)
                                <div class="badge rounded-pill {{ $evaluation->responsibility_score == $value ? 'text-bg-primary' : 'text-muted' }}">{{ $label }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4"><div>Fortalezas destacadas</div></div>
                        <div class="col">
                            <div class="ff-nunito fst-italic px-3">"{{$evaluation->strengths}}"</div>
                        </div>
                    </div>
                    @if($evaluation->improvements)
                    <div class="mb-3 row">
                        <div class="col-md-4"><div>Aspectos a mejorar</div></div>
                        <div class="col">
                            <div class="ff-nunito fst-italic px-3">"{{$evaluation->improvements}}"</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
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
                                    <li class="text-muted small">{{ $volunteer->birthdate->age }} años</li>
                                @endif
                                <li class="text-capitalize text-muted small">{{ $volunteer->profession }}</li>
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
                        <li class="text-muted small">{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</li>
                        <li class="text-muted small">{{ $project->location->name }} - {{ $project->location->province->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
