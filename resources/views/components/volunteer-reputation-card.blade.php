<ul class="list-unstyled mb-0">
@if($volunteer->evaluations->isNotEmpty())
    <li>Nivel: <span class="small text-muted">{{ $volunteer->global_performance_label }}</span></li>
@endif

@php
    $completed = $volunteer->reputation->completed_projects ?? 0;
    $total = ($volunteer->reputation->completed_projects ?? 0) + ($volunteer->reputation->cancelled_projects ?? 0);
    $completionPercentage = intval($volunteer->reputation->completion_rate ?? 0);
@endphp

@if($volunteer->reputation)
    <li>Voluntario: <span class="small text-muted">{{ ucfirst($volunteer->reputation->trust_level) }}</span></li>
    <li>Proyectos: <span class="small text-muted">
        @if($completionPercentage === 100)
            {{ $total }} {{ $total === 1 ? 'proyecto' : 'proyectos' }}
        @else
            Completó {{ $completed }} de {{ $total }} proyectos realizados (<span class="text-muted small">{{ $completionPercentage }}%</span>)
        @endif
    </span></li>
@endif
</ul>
