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
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 mb-0">Crear nueva condición</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.conditions.store') }}"
                                  method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="key"
                                           class="form-label">
                                        Key (separado-con-guion) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('key') is-invalid @enderror"
                                           id="key"
                                           name="key"
                                           value="{{ old('key') }}"
                                           placeholder="ejemplo-de-key"
                                           required>
                                    <small class="text-muted">Usar solo letras minúsculas, números y guiones</small>
                                    @error('key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name"
                                           class="form-label">
                                        Nombre de la condición <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Ejemplo de condición"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="enabled"
                                               value="1"
                                               id="enabled"
                                               {{ old('enabled') ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                               for="enabled">
                                            Habilitado
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.conditions.index') }}"
                                       class="btn btn-outline-primary">
                                        Cancelar
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Crear
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
