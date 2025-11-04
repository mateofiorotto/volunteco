@extends('layouts.admin')

@section('content')
<section>
    <div class="container py-5">
        <h1 class="title-h1 h3 mb-5">Listado de <span>Voluntarios</span></h1>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($volunteers as $volunteer)
                            <tr>
                                <th scope="row">{{ $volunteer->volunteer->id }}</th>
                                <td>{{ $volunteer->volunteer->full_name }}</td>
                                <td>{{ $volunteer->email }}</td>
                                <td>
                                    @if ($volunteer->status !== 'activo')
                                        <span class="text-uppercase fw-semibold badge {{ $volunteer->status === 'pendiente' ? 'text-bg-warning' : 'text-bg-danger'}}">
                                            {{ $volunteer->status }}
                                        </span>
                                    @else
                                        <span class="text-uppercase fw-semibold badge bg-transparent text-body">{{ $volunteer->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.volunteer.profile', $volunteer->id) }}" class="btn btn-sm btn-azul">Ver Perfil</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay voluntarios disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($volunteers->hasPages())
            <div class="d-flex justify-content-start mt-4">
                {{ $volunteers->links() }}
            </div>
        @endif
    </div>
</section>
@endsection