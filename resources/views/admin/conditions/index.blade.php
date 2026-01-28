@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
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
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Key</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col"
                                    class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conditions as $condition)
                                <tr>
                                    <td>{{ $condition->id }}</td>
                                    <td>{{ $condition->key }}</td>
                                    <td>{{ $condition->name }}</td>
                                    <td>
                                        @if ($condition->enabled)
                                            <span class="badge bg-transparent text-body">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="text-end d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.conditions.edit', $condition->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Editar
                                        </a>
                                        <a href="{{ route('admin.conditions.delete', $condition->id) }}"
                                           class="btn btn-sm btn-danger">
                                            Eliminar
                                        </a>
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
                    @if ($conditions->hasPages())
                        {{ $conditions->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
