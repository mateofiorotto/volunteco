@extends('layouts.admin')

@push('styles')
<style>
@media (max-width: 992px) {
    .volunteer-table .responsive-table {
        --table-header-width: 94px;
    }
}
</style>
@endpush

@section('content')
    <section>
        <div class="container py-md-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
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

                <div class="d-flex justify-content-end py-2 gap-2 mb-2">
                        <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
                        <div class="small"><i class="bi bi-circle-fill dot-inactivo"></i> Inactivo</div>
                    </div>

                    <div class="table-responsive volunteer-table">
                    <table class="table responsive-table">
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
                                <tr class="align-middle">
                                    <th scope="row">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><span class="d-lg-none"># </span>{{ $volunteer->id }}</div>
                                            <div class="d-lg-none dot-{{$volunteer->user->status}}"><i class="bi bi-circle-fill"></i></div>
                                        </div>
                                    </th>
                                    <td data-label="Nombre: "><a href="{{ route('admin.volunteer.profile', $volunteer->id) }}" target="_blank">{{ $volunteer->full_name }}</a></td>
                                    <td class="text-truncate" data-label="Email: "><a href="mailto:{{ $volunteer->user->email }}" target="_blank">{{ $volunteer->user->email }}</a></td>
                                    <td data-label="Estado" class="text-md-center hidden-mb">
                                        <div class="dot-{{$volunteer->user->status}} small"><i class="bi bi-circle-fill"></i></div>
                                    </td>
                                    <td class="text-md-center" data-label="Proyectos: ">{{ $volunteer->projects->count() }}</td>
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
