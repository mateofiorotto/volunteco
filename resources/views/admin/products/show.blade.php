@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Detalle del <span>producto</span></h1>
                <a href="{{ route('admin.products.index') }}"
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

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="d-flex g-0">
                                        <div class="avatar p-3">
                                            @if ($product->imagen)
                                                <img src="{{ asset('storage/' . $product->imagen) }}"
                                                     alt="Imagen del producto {{ $product->name }}"
                                                     class="object-fit-cover rounded"
                                                     width="120"
                                                     height="120">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                     style="width: 120px; height: 120px;">
                                                    <i class="bi bi-box-seam text-muted"
                                                       style="font-size: 3rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body flex-fill">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="small text-muted">Producto</div>
                                            </div>
                                            <h2 class="card-title h3">{{ $product->name }}</h2>
                                            <div class="row gap-5">
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        <li><span class="text-muted small">ID: </span>#{{ $product->id }}
                                                        </li>
                                                        <li><span class="text-muted small">Key:
                                                            </span><code>{{ $product->key }}</code></li>
                                                        <li><span class="text-muted small">Precio: </span><span
                                                                  class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-unstyled">
                                                        @if ($product->created_at)
                                                            <li><span class="text-muted small">Creado:
                                                                </span>{{ $product->created_at->format('d/m/Y') }}</li>
                                                        @endif
                                                        @if ($product->updated_at)
                                                            <li><span class="text-muted small">Actualizado:
                                                                </span>{{ $product->updated_at->format('d/m/Y') }}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">Descripción del producto</div>
                                    <div class="card-body">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Acciones</div>
                        <div class="card-body">
                            <p class="text-muted d-block small">
                                Puede editar la información de este producto o eliminarlo definitivamente.
                            </p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-pencil me-1"></i> Editar producto
                                </a>
                                <button type="button"
                                        class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#eliminarModal">
                                    <i class="bi bi-trash me-1"></i> Eliminar producto
                                </button>
                            </div>
                        </div>
                    </div>

                    @if ($product->imagen)
                        <div class="card">
                            <div class="card-header">Imagen del producto</div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $product->imagen) }}"
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade"
         id="eliminarModal"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5">Eliminar producto</h2>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar definitivamente este producto?</p>
                    <p class="text-muted small mb-0">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-primary"
                            data-bs-dismiss="modal">Cancelar</button>

                    <form method="POST"
                          id="deleteProductForm"
                          action="{{ route('admin.products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                type="submit">Sí, eliminar producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Cierro el modal manualmente cuando envio el form
        document.getElementById('deleteProductForm').addEventListener('submit', function() {
            const modalEl = document.getElementById('eliminarModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
        });
    </script>
@endsection
