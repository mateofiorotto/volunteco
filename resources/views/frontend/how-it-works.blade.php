@extends('layouts.app')

@section('title', 'Cómo funciona')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-how-it-works"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="text-center">
                <h1 class="hero-title">¿Cómo <span class="fw-light">Funciona</span>?</h1>
                <p class="hero-subtitle">Comenzá tu aventura en 4 simples pasos</p>
            </div>
        </div>
    </section>
     <section class="how-section bg-body-tertiary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>1</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Creá tu Perfil</h3>
                            <p class="step-text text-muted">Regístrate gratis como voluntario o anfitrión, solo toma unos
                                minutos.</p>
                        </div>
                    </div>

                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>2</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Proyectos</h3>
                            <p class="step-text text-muted">Si sos anfitrión podes crear proyectos de voluntariado
                                ecológico. Si sos voluntario podes aplicar para ayudar en ellos.</p>
                        </div>
                    </div>

                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>3</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Conectá</h3>
                            <p class="step-text text-muted">Podés conectar con otros usuarios de la plataforma una vez te
                                involucres en un proyecto.</p>
                        </div>
                    </div>

                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>4</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Viví la Experiencia</h3>
                            <p class="step-text text-muted">Entre todos ayudamos a crear un mundo mejor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
