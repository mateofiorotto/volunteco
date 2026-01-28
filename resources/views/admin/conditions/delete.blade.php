@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="mb-4">
                <a href="{{ route('admin.conditions.index') }}"
                   class="btn btn-link text-decoration-none"><i class="bi bi-chevron-left me-1"></i> Volver
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h1 class="h4 mb-0">Confirmar eliminación</h1>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">¿Estás seguro de que deseas eliminar esta condición?</p>

                            <div class="p-3 rounded mb-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <strong>Key:</strong> {{ $condition->key }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Nombre:</strong> {{ $condition->name }}
                                    </li>
                                    <li>
                                        <strong>Estado:</strong>
                                        @if ($condition->enabled)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.conditions.index') }}"
                                   class="btn btn-outline-primary">
                                    Cancelar
                                </a>
                                <form action="{{ route('admin.conditions.destroy', $condition->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
