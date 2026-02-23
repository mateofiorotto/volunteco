@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')

    <section class="error-hero-section">
        <div class="hero-error-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container text-center">
            <p class="error-number">404</p>
            <h1 class="hero-title">Página <span class="fw-light">no encontrada</span></h1>
            <p class="hero-subtitle">La página que buscás no existe o fue movida a otra dirección.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Ir al inicio</a>
        </div>
    </section>
@endsection