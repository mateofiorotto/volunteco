@extends('layouts.blank')

@section('title', 'Uníte a Volunteco')

@section('content')

    <!-- Hero Section -->
    <section class="landing-hero py-3">
        <div class="hero-bg-image"></div>
        <div class="hero-content container-md">
            <div class="hero-logo mb-5">
                <img class="img-fluid  d-block m-auto hero-img mb-md-5"
                     src="images/logo-white.svg"
                     alt="Volunteco"
                     width="300"
                     height="61">
            </div>
            <h1 class="hero-title fw-semibold">Cambiá el Mundo,<br>Una Acción a la Vez</h1>
            <p class="hero-subtitle">
                Uníte a <span class="fw-semibold ff-nunito fs-3">Volunt<span class="fw-light">eco</span></span>, la
                comunidad de voluntarios y anfitriones comprometidos con el planeta.
                Tu aventura empieza acá.
            </p>
            <a href="{{ route('home') }}"
               class="btn btn-lg btn-light fw-medium">Explorar Ahora</a>
        </div>
        <div class="scroll-indicator"
             id="scrollArrow">
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
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">120+</div>
                        <div class="stat-label">Proyectos Activos</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">1K+</div>
                        <div class="stat-label">Voluntarios</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Confiable</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container py-5">
            <div class="text-center">
                <h2 class="section-title">Elegí <span class="fw-semibold ff-nunito text-primary">Volunt<span class="fw-light">eco</span></span></h2>
                <p class="section-subtitle">Tu plataforma de confianza para voluntariado ecológico</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card bg-primary bg-opacity-25">
                        <div
                             class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-primary text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>

                        </div>
                        <h3 class="feature-title">Proyectos Nacionales</h3>
                        <p class="feature-text">Accedé o publicá proyectos de voluntariado ecológico en toda la República
                            Argentina.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card bg-azul bg-opacity-25">
                        <div
                             class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-azul bg-opacity-100 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>

                        </div>
                        <h3 class="feature-title">Verificado</h3>
                        <p class="feature-text">Todos nuestros proyectos y anfitriones están verificados. Tu seguridad y
                            experiencia son nuestra prioridad.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card bg-secondary bg-opacity-25">
                        <div
                             class="feature-icon mx-auto rounded-circle d-flex align-items-center justify-content-center bg-secondary bg-opacity-100 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
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
            <div class="text-center">
                <h2 class="section-title">¿Cómo <span class="fw-light">Funciona</span>?</h2>
                <p class="section-subtitle">Comenzá tu aventura en 4 simples pasos</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>1</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Creá tu Perfil</h3>
                            <p class="step-text text-muted">Registrate gratis como voluntario o anfitrión, solo toma unos
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

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Tu Aventura Te Está Esperando</h2>
                <p class="cta-subtitle fs-4 fw-light mb-5">Uníte a la comunidad de <span
                          class="fw-semibold ff-nunito text-marca">Volunt<span class="fw-light">eco</span></span> y dejá
                    tu huella</p>
                <a href="{{ route('home') }}"
                   class="btn btn-lg fw-medium btn-light">Comenzar Ahora</a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        document.getElementById("scrollArrow").addEventListener("click", () => {
            const sections = [...document.querySelectorAll("section")];
            const currentY = window.scrollY;

            const nextSection = sections.find(sec => sec.offsetTop > currentY + 10);

            if (nextSection) {
                nextSection.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    </script>
@endsection
