@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3">Tipos de <span>proyectos</span></h1>
                <a href="{{ route('admin.project-types.create') }}"
                   class="btn btn-primary">
                    Crear tipo de proyecto
                </a>
            </div>

            {{-- Alertas de error--}}
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

            <!-- Tabla de tipos de proyectos -->
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
                            @forelse($projectTypes as $projectType)
                                <tr>
                                    <td>{{ $projectType->id }}</td>
                                    <td>{{ $projectType->key }}</td>
                                    <td>{{ $projectType->name }}</td>
                                    <td>
                                        @if ($projectType->enabled)
                                            <span class="badge bg-transparent text-body">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="text-end d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.project-types.edit', $projectType->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Editar
                                        </a>
                                        <a href="{{ route('admin.project-types.delete', $projectType->id) }}"
                                           class="btn btn-sm btn-danger">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="text-center">
                                        No hay tipos de proyectos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($projectTypes->hasPages())
                        {{ $projectTypes->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
