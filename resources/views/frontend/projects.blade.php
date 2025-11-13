@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <h2>Proyectos</h2>
            <div class="projects-list">
                @if ($projects->isEmpty())
                    <p>No hay proyectos publicados actualmente.</p>
                @else
                    <div class="row justify-content-center">
                        @foreach ($projects as $project)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="304" height="228">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5">{{ $project->title }}</h3>
                                    <div class="mb-2">
                                        <span class="badge bg-primary">{{ $project->projectType->name }}</span>
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

                                    <div>
                                        <a href="{{ route('project', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                @endif
            </div>
        </div>
    </section>
@endsection
