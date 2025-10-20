@extends('layouts.app')

@section('content')
    <div class="container pt-5 pb-5">
        <h2>Mis Proyectos Aplicados</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($appliedProjects->isEmpty())
            <div class="alert alert-info">
                <h5>No has aplicado a ningún proyecto aún</h5>
                
            </div>
        @else
            <div class="row">
                @foreach($appliedProjects as $project)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $project->title }}"
                                     style="height: 200px; object-fit: cover;">
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title">{{ $project->title }}</h3>
                                
                                <div class="mb-2">
                                    <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                                    
                                    @if($project->pivot->status === 'Pendiente')
                                        <span class="badge bg-warning text-dark">⏳ Pendiente</span>
                                    @elseif($project->pivot->status === 'Aceptado')
                                        <span class="badge bg-success">✅ Aceptado</span>
                                    @elseif($project->pivot->status === 'Rechazado')
                                        <span class="badge bg-danger">❌ Rechazado</span>
                                    @endif
                                </div>

                                <p class="card-text text-muted small">
                                    {{ Str::limit($project->description, 100) }}
                                </p>

                                <div class="mt-auto">
                                    <p class="small mb-2">
                                        <strong>📍</strong> {{ $project->location }}<br>
                                        <strong>📅</strong> {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }} 
                                        - {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}<br>
                                        <strong>⏰</strong> {{ $project->work_hours_per_day }}<br>
                                        <strong>🏢</strong> {{ $project->host->name }}
                                    </p>

                                    <p class="small text-muted mb-3">
                                        Aplicado el: {{ \Carbon\Carbon::parse($project->pivot->applied_at)->format('d/m/Y H:i') }}
                                        @if($project->pivot->status === 'Aceptado' && $project->pivot->accepted_at)
                                            <br>Aceptado el: {{ \Carbon\Carbon::parse($project->pivot->accepted_at)->format('d/m/Y H:i') }}
                                        @endif
                                    </p>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('project', $project->id) }}" 
                                           class="btn btn-sm btn-outline-primary flex-grow-1">
                                            Ver Detalles
                                        </a>

                                        @if($project->pivot->status !== 'Rechazado')
                                            <form method="POST" 
                                                  action="{{ route('withdraw-project', $project->id) }}"
                                                  onsubmit="return confirm('¿Estás seguro de que deseas desistir de este proyecto?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Desistir
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $appliedProjects->links() }}
            </div>
        @endif
    </div>
@endsection