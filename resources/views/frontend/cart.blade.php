@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<section class="projects-hero bg-primary">
    <div class="container">
        <div class="projects-hero-content text-center">
            <h1 class="hero-title">Carrito</h1>
            <p class="hero-subtitle mw-100 px-lg-4">Cada compra contribuye a mantener activa y eficiente nuestra web.</p>
        </div>
    </div>
</section>
<!-- Productos del carrito -->
@if ($products->isNotEmpty())
    <section class="py-5 mb-2 bg-body-tertiary">
        <div class="container">
            <div class="card border-azul">
                <div class="card-header text-bg-azul">
                    <h2 class="h5 mb-0">Carrito <span class="small fw-light">(Total: 17)</span></h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            <!-- Filas generadas dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="cart-container"></div>

            <div id="cart-total" style="margin-top:20px; font-weight:bold;"></div>

        </div>
    </section>
@endif
@endsection
