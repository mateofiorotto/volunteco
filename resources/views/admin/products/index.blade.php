@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3">Listado de <span>productos</span></h1>
                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-primary">
                    Crear producto
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
                    <strong>¡Perfecto!</strong> {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Key</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                           class="btn btn-sm btn-azul">Ver producto</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center">
                                        No hay productos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($products->hasPages())
                        {{ $products->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
