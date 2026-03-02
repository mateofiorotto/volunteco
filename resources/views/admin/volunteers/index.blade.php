@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3">Listado de <span>voluntarios</span></h1>
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
                <div class="col-md-10 mx-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Proyectos</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($volunteers as $volunteer)
                                <tr>
                                    <th scope="row">{{ $volunteer->id }}</th>
                                    <td><a href="{{ route('admin.volunteer.profile', $volunteer->id) }}" target="_blank">{{ $volunteer->full_name }}</a></td>
                                    <td><a href="mailto:{{ $volunteer->user->email }}" target="_blank">{{ $volunteer->user->email }}</a></td>
                                    <td class="text-center">
                                        @if ($volunteer->user->status !== 'activo')
                                            <span
                                                  class="text-capitalize badge {{ $volunteer->user->status === 'pendiente' ? 'text-bg-warning' : 'bg-danger' }}">{{ $volunteer->user->status }}</span>
                                        @else
                                            <span
                                                  class="text-capitalize badge bg-transparent text-body">{{ $volunteer->user->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $volunteer->projects->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.volunteer.profile', $volunteer->id) }}"
                                           class="btn btn-sm btn-azul">Ver perfil</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center">No hay voluntarios disponibles</td>
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
