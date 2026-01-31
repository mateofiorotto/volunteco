@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <!-- Detalle del Producto -->
    <section class="py-5 mt-2">
        <div class="container">
            <div class="row g-5">
                <!-- Imagen del Producto -->
                <div class="col-lg-6">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('storage/' . ($product->image ?? 'thumbnail-producto.jpg')) }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded shadow-sm w-100">
                    </div>
                </div>

                <!-- Info Producto -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h1 class="h2 mb-4 ff-nunito">{{ $product->name }}</h1>

                        <!-- Precio -->
                        <div class="mb-4">
                            <p class="h3 mb-0 text-primary fw-bold">
                                ${{ number_format($product->price, 2) }} ARS
                            </p>
                        </div>

                        <!-- Descripcion -->
                        <div class="mb-4">
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>

                        <!-- cantidad y btn de Compra -->
                        <div>
                            <button type="submit"
                                    class="btn btn-primary btn-md">
                                Comprar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Relacionados -->
    @if ($relatedProducts->isNotEmpty())
        <section class="py-5 mb-2">
            <div class="container">
                <h2 class="section-title text-center text-primary mb-5">
                    También te puede <span class="fw-light">interesar</span>
                </h2>

                <div class="row g-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-md-6 col-lg-4">
                            <div class="card product-card h-100">
                                <div class="position-relative">
                                    <a href="{{ route('product', $relatedProduct->id) }}">
                                        <img src="{{ asset('storage/' . ($relatedProduct->image ?? 'default-product.jpg')) }}"
                                             class="card-img-top object-fit-cover"
                                             alt="{{ $relatedProduct->name }}"
                                             style="height: 280px;">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 ff-nunito">
                                        <a href="{{ route('product', $relatedProduct->id) }}"
                                           class="text-decoration-none text-dark">
                                            {{ $relatedProduct->name }}
                                        </a>
                                    </h3>

                                    <p class="card-text small text-muted mb-3">
                                        {{ Str::limit($relatedProduct->description, 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <p class="h5 mb-0 text-primary fw-bold">
                                                    ${{ number_format($relatedProduct->price, 2) }}
                                                </p>
                                            </div>
                                        </div>

                                        <a href="{{ route('product', $relatedProduct->id) }}"
                                           class="btn btn-azul w-100">
                                            Ver detalles
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="2"
                                                 stroke="currentColor"
                                                 width="16"
                                                 height="16"
                                                 style="display: inline; margin-left: 5px;">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
