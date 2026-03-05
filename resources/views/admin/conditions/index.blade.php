@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-md-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title-h1 h3"><span>Condiciones</span></h1>
                <a href="{{ route('admin.conditions.create') }}"
                   class="btn btn-primary">
                    Crear condición
                </a>
            </div>

            {{-- Alertas --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    {{ session('error') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Tabla de condiciones -->
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="d-flex justify-content-end py-2 gap-2">
                        <div class="small"><i class="bi bi-circle-fill dot-activo"></i> Activo</div>
                        <div class="small"><i class="bi bi-circle-fill dot-desactivado"></i> Desactivado</div>
                    </div>

                    <div class="table-responsive">
                        <table class="table responsive-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Key</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" class="text-center">Estado</th>
                                    <th scope="col"
                                        class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($conditions as $condition)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div><span class="d-lg-none"># </span>{{ $condition->id }}</div>
                                                <div class="d-lg-none dot-{{$condition->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                            </div>
                                        </th>
                                        <td data-label="Key: ">{{ $condition->key }}</td>
                                        <td data-label="Nombre: ">{{ $condition->name }}</td>
                                        <td class="text-center hidden-mb">
                                            <div class="dot-{{$condition->enabled == true ? 'activo' : 'desactivado'}}"><i class="bi bi-circle-fill"></i></div>
                                        </td>
                                        <td class="text-lg-center">
                                            <div class="d-flex gap-3 justify-content-lg-center">
                                                <a href="{{ route('admin.conditions.edit', $condition->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                    Editar
                                                </a>
                                                <a href="{{ route('admin.conditions.delete', $condition->id) }}"
                                                class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="text-center">
                                            No hay condiciones registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($conditions->hasPages())
                        {{ $conditions->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
