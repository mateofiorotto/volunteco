@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="projects-hero bg-primary">
        <div class="container">
            <div class="projects-hero-content text-center">
                <h1 class="hero-title">Tienda <span class="fw-light">solidaria</span></h1>
                <p class="hero-subtitle mw-100 px-lg-4">Cada compra contribuye a mantener activa y eficiente nuestra web.</p>
            </div>
        </div>
    </section>

    <!-- Detalle del Producto -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Imagen del Producto -->
                <div class="col-md-6">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('storage/' . ($product->image ?? 'thumbnail-proyecto.jpg')) }}"
                             alt="{{ $product->name }}"
                             width="626"
                             height="352"
                             class="img-fluid rounded border border-primary w-100">
                    </div>
                </div>

                <!-- Info Producto -->
                <div class="col-md-5 offset-md-1 mx-auto">
                    <div class="product-info">
                        <h2 class="h1 mb-4 ff-nunito">{{ $product->name }}</h2>

                        <!-- Precio -->
                        <div class="mb-4">
                            <p class="h3 mb-0 text-primary fw-bold">
                                $ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                        </div>

                        <!-- Descripcion -->
                        <div class="mb-4">
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>

                        <!-- cantidad y btn de Compra -->
                        <div class="input-group mb-4">
                            <label class="input-group-text"><small> Cantidad: </small></label>
                            <input id="product-quantity" type="number" class="product-quantity form-control" placeholder="1" value="1" min="1">
                        </div>

                        <div class="mb-4">
                            <button type="button" data-product='@json($product)' data-cart-url="{{ route('cart') }}" class="btn btn-primary btn-md add-to-cart">
                                Comprar
                            </button>
                        </div>

                        <div id="cart-message" class="text-bg-warning rounded p-3 cart-message">
                            El producto se agregó correctamente al carrito
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos relacionados -->
    @if ($relatedProducts->isNotEmpty())
        <section class="py-5 mb-2 bg-body-tertiary">
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
                                        <img src="{{ asset('storage/' . ($relatedProduct->image ?? 'thumbnail-proyecto.jpg')) }}"
                                             class="card-img-top object-fit-cover"
                                             alt="{{ $relatedProduct->name }}" width="409" height="280">
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
                                                    $ {{ number_format($relatedProduct->price, 2, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>

                                        <a href="{{ route('product', $relatedProduct->id) }}"
                                           class="btn btn-azul w-100">
                                            Ver más
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
