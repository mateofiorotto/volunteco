@extends('layouts.admin')

@push('styles')
<style>
@foreach($projectTypes as $type)
    .badge-{{ $type->key }} {
        border: 2px solid {{ $type->color }};
        color: {{ $type->color }}!important;
        background-color: #ffffff;
        /* background-color: {{ $type->color }}; */
    }
@endforeach
</style>

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
                <div class="col-md-10 mx-auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Key</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projectTypes as $projectType)
                                    <tr class="align-middle">
                                        <td>{{ $projectType->id }}</td>
                                        <td>{{ $projectType->key }}</td>
                                        <td>{{ $projectType->name }}</td>
                                        <td><div class="badge-{{$projectType->key}} badge">{{ $projectType->color }}</div></td>
                                        <td>
                                            @if ($projectType->enabled)
                                                <span class="small">Activo</span>
                                            @else
                                                <span class="small text-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('admin.project-types.edit', $projectType->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                    Editar
                                                </a>
                                                <a href="{{ route('admin.project-types.delete', $projectType->id) }}"
                                                class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
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
        </div>
    </section>
@endsection
