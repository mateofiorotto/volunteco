@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Condiciones</h1>
                    <button class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-1"></i> Agregar Condición
                    </button>
                </div>

                {{-- Alerta de errores general --}}
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Key</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creación</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($conditions as $condition)
                                        <tr>
                                            <td>{{ $condition->id }}</td>
                                            <td><code>{{ $condition->key }}</code></td>
                                            <td>{{ $condition->name }}</td>
                                            <td>
                                                @if ($condition->enabled)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>{{ $condition->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $condition->id }}">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $condition->id }}">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Editar -->
                                        <div class="modal fade"
                                             id="editModal{{ $condition->id }}"
                                             tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Condición</h5>
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('admin.conditions.update', $condition->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="key_edit{{ $condition->id }}"
                                                                       class="form-label">Key (separado_con_guion) <span
                                                                          class="text-danger">*</span></label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="key_edit{{ $condition->id }}"
                                                                       name="key"
                                                                       value="{{ $condition->key }}"
                                                                       placeholder="ejemplo-de-key"
                                                                       required>
                                                                <small class="text-muted">Usar solo letras minúsculas,
                                                                    números y guiones</small>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="name_edit{{ $condition->id }}"
                                                                       class="form-label">Nombre de la Condición <span
                                                                          class="text-danger">*</span></label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="name_edit{{ $condition->id }}"
                                                                       name="name"
                                                                       value="{{ $condition->name }}"
                                                                       required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                           type="checkbox"
                                                                           name="enabled"
                                                                           value="1"
                                                                           id="enabled_edit{{ $condition->id }}"
                                                                           {{ $condition->enabled ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                           for="enabled_edit{{ $condition->id }}">
                                                                        Habilitado
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit"
                                                                    class="btn btn-primary">
                                                                <i class="bi bi-check-circle me-1"></i> Actualizar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Eliminar -->
                                        <div class="modal fade"
                                             id="deleteModal{{ $condition->id }}"
                                             tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar la condición?</p>
                                                        <ul class="list-unstyled">
                                                            <li><strong>Key:</strong> <code>{{ $condition->key }}</code>
                                                            </li>
                                                            <li><strong>Nombre:</strong> {{ $condition->name }}</li>
                                                        </ul>
                                                        <div class="alert alert-danger mb-0">
                                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                                            Esta acción no se puede deshacer.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('admin.conditions.destroy', $condition->id) }}"
                                                              method="POST"
                                                              class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="text-center text-muted py-4">No hay condiciones registradas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($conditions->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Mostrando {{ $conditions->firstItem() }} a {{ $conditions->lastItem() }} de
                                    {{ $conditions->total() }} registros
                                </div>
                                <div>
                                    {{ $conditions->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade"
         id="createModal"
         tabindex="-1"
         aria-labelledby="createModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="createModalLabel">Agregar Nueva Condición</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.conditions.store') }}"
                      method="POST"
                      id="createConditionForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="key_create"
                                   class="form-label">Key (separado-con-guion) <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('key') is-invalid @enderror"
                                   id="key_create"
                                   name="key"
                                   value="{{ old('key') }}"
                                   placeholder="ejemplo-de-key"
                                   required>
                            <small class="text-muted">Usar solo letras minúsculas, números y guiones</small>
                            @error('key')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name_create"
                                   class="form-label">Nombre de la Condición <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name_create"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Ejemplo de Condición"
                                   required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="enabled"
                                       value="1"
                                       id="enabled_create"
                                       {{ old('enabled') ? 'checked' : '' }}>
                                <label class="form-check-label"
                                       for="enabled_create">
                                    Habilitado
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit"
                                class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var createModal = new bootstrap.Modal(document.getElementById('createModal'));
                createModal.show();
            });
        </script>
    @endif
@endsection
