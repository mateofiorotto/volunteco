@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <h1 class="title-h1 h3 mb-5">Listado de <span>Voluntarios</span></h1>

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
                                    <th scope="row">{{ $volunteer->user_id }}</th>
                                    <td>{{ $volunteer->full_name }}</td>
                                    <td>{{ $volunteer->user->email }}</td>
                                    <td>
                                        @if ($volunteer->user->status !== 'activo')
                                            <span class="text-uppercase fw-semibold badge {{$volunteer->user->status === 'pendiente' ? 'text-bg-warning' : 'bg-danger'}}">{{ $volunteer->user->status }}</span>
                                        @else
                                            <span class="text-uppercase fw-semibold badge bg-transparent text-body">{{ $volunteer->user->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.volunteer.profile', $volunteer->user_id) }}"
                                           class="btn btn-sm btn-azul">Ver Perfil</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay voluntarios disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($volunteers->hasPages())
                        <div>
                            {{ $volunteers->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection
