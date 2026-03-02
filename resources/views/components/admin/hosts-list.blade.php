<ul class="list-group list-group-flush">
    @foreach ($hosts as $host)
        <li class="list-group-item">
            <div class="row align-items-center">
                <div class="col-12 col-md-4">
                    {{ $host->name ?? 'Sin nombre' }}
                    @if (!$host->user->disabled_at && $host->user->status === 'pendiente')
                        <span class="badge text-bg-primary">Nuevo</span>
                    @endif
                </div>
                <div class="col-12 {{$host->user->status === 'activo' ? 'col-md-4' : 'col-md-6'}}">
                    <a href="mailto:{{$host->user->email}}" target="_blank">{{$host->user->email}}</a>
                </div>
                @if($host->user->status === 'activo')
                    <div class="col-12 col-md-2">{{$host->projects_count}}</div>
                @endif
                <div class="col-12 col-md-2 text-center">
                    <a href="{{ route('admin.hosts.profile', $host->id) }}"
                       class="btn btn-sm btn-azul"
                       title="ver">
                        Ver
                    </a>
                </div>
            </div>
        </li>
    @endforeach
</ul>
