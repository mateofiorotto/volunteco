@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="mb-4">
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-link text-decoration-none"><i class="bi bi-chevron-left me-1"></i> Volver
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 mb-0">Crear nuevo producto</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
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
                                           placeholder="producto-ejemplo"
                                           required>
                                    <small class="text-muted">Identificador único del producto. Usar solo letras minúsculas,
                                        números y guiones</small>
                                    @error('key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name"
                                           class="form-label">
                                        Nombre del producto <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Nombre del producto"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description"
                                           class="form-label">
                                        Descripción <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="4"
                                              placeholder="Descripción del producto"
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price"
                                               class="form-label">
                                            Precio <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   id="price"
                                                   name="price"
                                                   value="{{ old('price') }}"
                                                   step="0.01"
                                                   min="0"
                                                   placeholder="0.00"
                                                   required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="stock"
                                               class="form-label">
                                            Stock <span class="text-danger">*</span>
                                        </label>
                                        <input type="number"
                                               class="form-control @error('stock') is-invalid @enderror"
                                               id="stock"
                                               name="stock"
                                               value="{{ old('stock', 0) }}"
                                               min="0"
                                               placeholder="0"
                                               required>
                                        <small class="text-muted">Cantidad disponible en inventario</small>
                                        @error('stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="imagen"
                                           class="form-label">Imagen del producto</label>
                                    <input type="file"
                                           class="form-control @error('imagen') is-invalid @enderror"
                                           id="imagen"
                                           name="imagen"
                                           accept="image/jpeg,image/png,image/jpg,image/gif">
                                    <small class="text-muted">
                                        Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB
                                    </small>
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.products.index') }}"
                                       class="btn btn-outline-primary">
                                        Cancelar
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Crear producto
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
