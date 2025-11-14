<ul class="list-group list-group-flush">
    @foreach ($hosts as $host)
        <li class="list-group-item">
            <div class="row align-items-center">
                <div class="col-12 col-md-5">
                    {{ $host->host->name ?? 'Sin nombre' }}
                    @if (!$host->host->disabled_at && $host->status === 'pendiente' )
                        <span class="badge text-bg-primary text-uppercase">nuevo</span>
                    @endif
                </div>
                <div class="col-12 col-md-5">
                    {!! $host->email ? '<a href="mailto:' . $host->email . '" target="_blank">' . $host->email . '</a>' : 'Sin email' !!}
                </div>
                <div class="col-12 col-md-2 text-center">
                    <a href="{{ route('admin.hosts.profile', $host->id) }}" class="btn btn-sm btn-azul" title="ver">
                        Ver
                    </a>
                </div>
            </div>
        </li>
    @endforeach
</ul>
