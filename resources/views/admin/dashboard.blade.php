@extends('layouts.app')

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="title-h1 h3 mb-0">Panel de <span>Administración</span></h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header text-bg-primary">
                    <h2 class="h5 mb-0">Últimos Anfitriones <span class="small fw-light">(Total: {{$hostCount}})</span></h2>
                </div>
                <div class="card-body">
                    @if($hostsLast->isEmpty())
                        <p>No hay anfitriones registrados.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hostsLast as $host)
                                    <tr>
                                        <th scope="row">{{ $host->id}}</th>
                                        <td>{{ $host->host->name }}</td>
                                        <td><a href="mailto:{{ $host->email }}" target="_blank">{{ $host->email }}</a></td>
                                        <td>
                                        @if ($host->status !== 'activo')
                                            <span class="text-uppercase fw-semibold badge {{ $host->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger'}}">
                                                {{ $host->status }}
                                            </span>
                                        @else
                                            <span class="text-uppercase fw-semibold badge bg-success">{{ $host->status }}</span>
                                        @endif
                                        </td>
                                        <td><a href="{{ route('admin.hosts.profile', $host->id) }}" class="btn btn-sm btn-azul" title="ver">Ver</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header text-bg-warning">
                    <h2 class="h5 mb-0">Últimos Volutarios <span class="small fw-light">(Total: {{$volunteerCount}})</span></h2>
                </div>
                <div class="card-body">
                    @if($volunteersLast->isEmpty())
                        <p>No hay voluntarios registrados.</p>
                    @else
                        <table class="table border-warning">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteersLast as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id}}</th>
                                        <td>{{ $volunteer->volunteer->full_name }}</td>
                                        <td><a href="mailto:{{ $volunteer->email }}" target="_blank">{{ $volunteer->email }}</a></td>
                                        <td>
                                            @if ($volunteer->status !== 'activo')
                                                <span class="text-uppercase fw-semibold badge {{ $volunteer->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger'}}">
                                                    {{ $volunteer->status }}
                                                </span>
                                            @else
                                                <span class="text-uppercase fw-semibold badge bg-success">{{ $volunteer->status }}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('admin.volunteer.profile', $volunteer->id) }}" class="btn btn-sm btn-azul" title="ver">Ver</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
