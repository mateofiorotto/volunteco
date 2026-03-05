<div class="table-responsive">
    <table class="table responsive-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col" class="text-md-center">Estado</th>
                <th scope="col"
                    class="text-md-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <th scope="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="d-lg-none"># </span>{{ $item->id }}</div>
                            <div class="d-lg-none dot-{{$item->user->status}}"><i class="bi bi-circle-fill"></i></div>
                        </div>
                    </th>
                    <td data-label="Nombre:">{{ $item->name }} {{ $item->lastname ?? $item->lastname}}</td>
                    <td data-label="Email:" class="text-truncate"><a href="mailto:{{ $item->user->email }}"
                        target="_blank">{{ $item->user->email }}</a></td>
                    <td data-label="Estado" class="text-md-center hidden-mb">
                        <div class="dot-{{$item->user->status}} small"><i class="bi bi-circle-fill"></i></div>
                    </td>
                    <td class="text-md-center"><a
                        href="{{ route($routeLink, $item->id) }}"
                        class="btn btn-sm btn-azul"
                        title="ver">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
