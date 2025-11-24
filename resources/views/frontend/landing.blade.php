@extends('layouts.blank')

@section('title', 'Cambia el Mundo, Una Acción a la Vez')

@section('styles')
<style>

    .landing-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 679px;
        width: 100%;
        aspect-ratio: 19 / 9;
    }

    .hero-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                rgba(102, 128, 10, 0.7) 0%,
                rgba(34, 63, 5, 0.8) 100%),
            url('images/landing-hero.jpg') center/cover;
        z-index: 1;
    }

    .hero-content {
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-title {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 3rem;
        line-height: 1.6;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
    }

    .btn-landing {
        padding: 18px 50px;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-landing-primary {
        background: white;
        color: var(--bs-primary);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .btn-landing-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        color: var(--bs-primary-dark);
    }

    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        40% {
            transform: translateX(-50%) translateY(-10px);
        }

        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }

    .scroll-indicator svg {
        width: 30px;
        height: 30px;
        color: white;
        opacity: 0.8;
    }

    /* Stats Section */
    .stats-section {
        background: var(--bs-primary);
        color: white;
        padding: 80px 0;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
    }

    .stat-number {
        font-size: 4rem;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        margin-bottom: 10px;
        line-height: 1;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* Features Section */
    .section-title {
        font-size: 3rem;
        text-align: center;
        margin-bottom: 1rem;
        color: var(--bs-body-color);
    }

    .section-subtitle {
        font-size: 1.3rem;
        text-align: center;
        margin-bottom: 60px;
        font-weight: 300;
    }

    .feature-card {
        text-align: center;
        padding: 40px 30px;
        border-radius: 20px;
        background: white;
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
    }

    .feature-icon svg {
        width: 40px;
        height: 40px;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    /* How it Works */
    .how-section {
        padding: 100px 0;
        background: white;
    }

    .step-item {
        padding: 30px;
        margin-bottom: 40px;
    }

    .step-number {
        content: '';
        display: block;
        border: 1px solid var(--bs-secondary);
        padding: 6px;
        position: relative;
        z-index: 0;
        border-radius: 50%;
    }
    .step-number span {
        display: block;
        width: 60px;
        height: 60px;
        flex: 0 0 60px;
        line-height: 60px;
        text-align: center;
        background: var(--bs-secondary);
        color: white;
        border-radius: 50%;
        font-size: 1.8rem;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        position: relative;
    }
    .step-number + .step-content { padding-top: 13px;}

    .step-title {
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: var(--bs-body-color);
    }

    /* CTA Section */
    .cta-section {
        background-image: linear-gradient(
            rgba(34, 63, 5, 0.98),
            rgba(102, 128, 10, 0.75)
        ), /* color overlay */
        url('images/madre-e-hija-preparandose-para-plantar-un-arbol-en-el-bosque.jpg');
        background-color: var(--bs-primary);
        background-size: cover, cover;
        background-position: center center;
        background-repeat:  no-repeat;
        padding: 100px 0;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-content {
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-size: 3.5rem;
        margin-bottom: 20px;
    }

    .cta-subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 40px;
        opacity: 0.95;
    }

    .btn-landing-white {
        background: white;
        color: var(--bs-primary);
    }

    .btn-landing-white:hover {
        background: var(--bs-light);
        color: var(--bs-primary-dark);
    }

    .hero-img {
        max-width: 300px;
    }

</style>
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="landing-hero">
        <div class="hero-bg-image"></div>
        <div class="hero-content container-md">
            <div class="hero-logo mb-5">
                <img class="img-fluid hero-img mb-5" src="images/logo-white.svg" alt="Volunteco" width="300" height="61">
            </div>
            <h1 class="hero-title fw-semibold">Cambía el Mundo,<br>Una Acción a la Vez</h1>
            <p class="hero-subtitle">
                Uníte a la comunidad de voluntarios y anfitriones comprometidos con el planeta.
                Tu aventura empieza acá.
            </p>
            <a href="{{ route('home') }}"
               class="btn-landing btn-landing-primary">
                Explorar Ahora
            </a>
        </div>
        <div class="scroll-indicator">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="2"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">120+</div>
                        <div class="stat-label">Proyectos Activos</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">1K+</div>
                        <div class="stat-label">Voluntarios</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Confiable</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container py-5">
            <h2 class="section-title">¿Por Qué <span class="fw-light">Elegirnos</span>?</h2>
            <p class="section-subtitle">Tu plataforma de confianza para voluntariado ecológico</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card bg-primary bg-opacity-25">
                        <div class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-primary text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>

                        </div>
                        <h3 class="feature-title">Proyectos Nacionales</h3>
                        <p class="feature-text">Accedé o publicá proyectos de voluntariado ecológico en toda la República Argentina.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card bg-azul bg-opacity-25">
                        <div class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-azul bg-opacity-100 text-white mb-4">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>

                        </div>
                        <h3 class="feature-title">Verificado</h3>
                        <p class="feature-text">Todos nuestros proyectos y anfitriones están verificados. Tu seguridad y
                            experiencia son nuestra prioridad.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card bg-secondary bg-opacity-25">
                        <div class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-secondary bg-opacity-100 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>

                        </div>
                        <h3 class="feature-title">Impacto Real</h3>
                        <p class="feature-text">Tu trabajo genera un impacto medible. Recibe certificados y reportes de
                            tu contribución al medio ambiente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-section bg-body-tertiary">
        <div class="container">
            <h2 class="section-title">¿Cómo <span class="fw-light">Funciona</span>?</h2>
            <p class="section-subtitle">Comenzá tu aventura en 4 simples pasos</p>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>1</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Creá tu Perfil</h3>
                            <p class="step-text text-muted">Regístrate gratis como voluntario o anfitrión, solo toma unos minutos.</p>
                        </div>
                    </div>

                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>2</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Proyectos</h3>
                            <p class="step-text text-muted">Si sos anfitrión podes crear proyectos de voluntariado ecológico. Si sos voluntario podes aplicar para ayudar en ellos.</p>
                        </div>
                    </div>

                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>3</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Conectá</h3>
                            <p class="step-text text-muted">Podés conectar con otros usuarios de la plataforma una vez te involucres en un proyecto.</p>
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

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Tu Aventura Te Está Esperando</h2>
                <p class="cta-subtitle">Unite a la comunidad y dejá tu huella</p>
                <a href="{{ route('home') }}"
                   class="btn-landing btn-landing-white">
                    Comenzar Ahora
                </a>
            </div>
        </div>
    </section>
@endsection
