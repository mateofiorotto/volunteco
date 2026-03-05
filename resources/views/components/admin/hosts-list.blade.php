<div {{ $attributes->merge(['class' => 'table-responsive']) }}>
    <table class="table responsive-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col" class="text-md-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hosts as $host)
                <tr>
                    <th scope="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="d-lg-none"># </span>{{ $host->id }}</div>
                            @if (!$host->user->disabled_at && $host->user->status === 'pendiente')
                                <span class="d-lg-none badge text-bg-primary px-2 ms-1"><i class="bi bi-bell-fill"></i></span>
                            @endif
                        </div>
                    </th>
                    <td data-label="Nombre:">
                        {{ $host->name }} {{ $host->lastname ?? $host->lastname}}
                        @if (!$host->user->disabled_at && $host->user->status === 'pendiente')
                            <span class="badge text-bg-primary px-2 ms-1 hidden-mb"><i class="bi bi-bell-fill"></i></span>
                        @endif
                    </td>
                    <td data-label="Email:" class="text-truncate"><a href="mailto:{{ $host->user->email }}"
                        target="_blank">{{ $host->user->email }}</a></td>
                    <td class="text-md-center"><a
                        href="{{ route('admin.hosts.profile', $host->id) }}"
                        class="btn btn-sm btn-azul"
                        title="ver">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
