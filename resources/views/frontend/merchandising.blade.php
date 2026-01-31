@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="hero-title">Nuestros <span class="fw-light">productos</span></h1>
            <p class="hero-subtitle">Descubrí nuestra selección de productos orgánicos y sustentables.</p>
        </div>
    </section>

    <!-- Listado de Productos -->
    <section class="py-5">
        <div class="container">
            @if ($products->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                    <h3>No hay productos disponibles</h3>
                    <p>Actualmente no hay productos en stock. Te invitamos a volver pronto.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card product-card h-100">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . ($product->image ?? 'thumbnail-producto.jpg')) }}"
                                         class="card-img-top object-fit-cover"
                                         alt="{{ $product->name }}">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 ff-nunito">{{ $product->name }}</h3>

                                    <p class="card-text small text-muted mb-3">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <p class="h5 mb-0 text-primary fw-bold">
                                                    {{ number_format($product->price, 2) }} ARS
                                                </p>
                                            </div>
                                        </div>

                                        <a href="{{ route('product', $product->id) }}"
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

                @if ($products->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
