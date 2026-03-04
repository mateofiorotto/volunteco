<ul class="list-unstyled mb-0">

@php
    $completed = $volunteer->reputation->completed_projects ?? 0;
    $total = ($volunteer->reputation->completed_projects ?? 0) + ($volunteer->reputation->cancelled_projects ?? 0);
    $completionPercentage = intval($volunteer->reputation->completion_rate ?? 0);
@endphp

@if($volunteer->reputation)
    <li>
        @if($volunteer->reputation->trust_level === 'activo')
        <div class="d-block py-2">
            <img src="{{ asset('images/insignias/nivel-activo.svg') }}" width="60" height="60" alt="{{ ucfirst($volunteer->reputation->trust_level) }}<"/>
        </div>
        @endif
        @if($volunteer->reputation->trust_level === 'destacado')
        <div class="d-block py-2">
            <img src="{{ asset('images/insignias/nivel-destacado.svg') }}" width="60" height="60" alt="{{ ucfirst($volunteer->reputation->trust_level) }}<"/>
        </div>
        @endif
        @if($volunteer->reputation->trust_level === 'embajador')
        <div class="d-block py-2">
            <img src="{{ asset('images/insignias/nivel-embajador.svg') }}" width="60" height="60" alt="{{ ucfirst($volunteer->reputation->trust_level) }}<"/>
        </div>
        @endif
    </li>
    @if($volunteer->evaluations->isNotEmpty())
        <li>Nivel: <span class="small text-muted">{{ $volunteer->global_performance_label }}</span></li>
    @endif
    <li>Proyectos: <span class="small text-muted">
        @if($completionPercentage === 100)
            {{ $total }} {{ $total === 1 ? 'proyecto' : 'proyectos' }}
        @elseif($completionPercentage === 0)
            No realizó ningún proyecto aún.
        @else
            Completó {{ $completed }} de {{ $total }} proyectos realizados (<span class="text-muted small">{{ $completionPercentage }}%</span>)
        @endif
    </span></li>
@endif
</ul>
