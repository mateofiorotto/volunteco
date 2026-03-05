@extends('layouts.admin')

@push('styles')
<style>
@media (max-width: 992px) {
    .project-table .responsive-table {
        --table-header-width: 106px;
    }
}
</style>
@endpush

@section('content')
    <section>
        <div class="container py-md-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title-h1 h3">Listado de <span>anfitriones</span></h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>


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
                <div class="col-12 col-md-6 mb-5">
                    <div class="card border-warning">
                        <div class="card-header text-bg-warning">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">pendientes de verificación</span></h2>
                        </div>
                        @if ($hostsNotVerified->isEmpty())
                            <div class="card-body">
                                <p class="mb-0">No hay anfitriones para verificar</p>
                            </div>
                        @else
                            <div class="card-body">
                                <x-admin.hosts-list :hosts="$hostsNotVerified" />
                            </div>
                            @if ($hostsNotVerified->hasPages())
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $hostsNotVerified->links() }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="card border-danger">
                        <div class="card-header text-bg-danger">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">deshabilitados / rechazados</span></h2>
                        </div>
                        @if ($hostsDisabled->isEmpty())
                            <div class="card-body">
                                <p class="mb-0">No hay anfitriones rechazados</p>
                            </div>
                        @else
                            <div class="card-body">
                                <x-admin.hosts-list :hosts="$hostsDisabled" />
                            </div>
                            @if ($hostsDisabled->hasPages())
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $hostsDisabled->links() }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mb-5 border-primary">
                        <div class="card-header text-bg-primary">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">activos</span></h2>
                        </div>
                        @if ($hostsVerified->isEmpty())
                            <div class="card-body">
                                <p class="mb-0 small">No hay anfitriones activos</p>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="table-responsive project-table">
                                    <table class="table responsive-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Email</th>
                                                <th scope="col" class="text-center">Proyectos</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hostsVerified as $host)
                                            <tr>
                                                <th>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div><span class="d-lg-none"># </span>{{ $host->id }}</div>
                                                    </div>
                                                </th>
                                                <td data-label="Nombre:">
                                                    {{ $host->name ?? 'Sin nombre' }}
                                                    @if (!$host->user->disabled_at && $host->user->status === 'pendiente')
                                                        <span class="badge text-bg-primary">Nuevo</span>
                                                    @endif
                                                </td>
                                                <td data-label="Email:" class="text-truncate"><a href="mailto:{{$host->user->email}}" target="_blank">{{$host->user->email}}</a></td>
                                                <td data-label="Proyectos:" class="text-lg-center">
                                                    @if($host->user->status === 'activo')
                                                    <div>{{$host->projects_count}}</div>
                                                    @endif
                                                </td>
                                                <td class="text-lg-center">
                                                    <a href="{{ route('admin.hosts.profile', $host->id) }}"
                                                        class="btn btn-sm btn-azul"
                                                        title="ver">
                                                        Ver
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if ($hostsVerified->hasPages())
                                <div class="card-footer">
                                     {{ $hostsVerified->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
