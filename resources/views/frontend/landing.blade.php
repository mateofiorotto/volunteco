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

            <div class="row g-4 align-items-center">
                <div class="col-md-5 mx-auto order-md-last order-first">
                    <h2 class="section-title">¿Qué es <span class="fw-semibold ff-nunito text-primary">Volunt<span class="fw-light">eco</span></span></h2>
                    <p class="section-subtitle">La plataforma que une compromiso ambiental con proyectos locales</p>
                    <p><span class="fw-semibold ff-nunito text-primary text-volunteco">Volunt<span class="fw-light">eco</span></span> nace para facilitar el encuentro entre voluntarios y anfitriones que necesitan apoyo en tareas ecológicas.
Creamos un espacio confiable, curado y regulado para que cada experiencia sea positiva, significativa y segura.</p>
                </div>
                <div class="col-md-5 offset-md-1">
                    <img src="{{asset('images/voluntariado.png')}}" width="550" height="512" alt="Voluntariado" class="img-fluid mx-auto"/>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container pb-5">
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

            <div class="row justify-content-center mb-5">
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

            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-5">
                <a href="{{route('register-host.create')}}" class="btn btn-lg btn-primary d-flex align-items-center">
                    <i class="btn-icon align-middle me-3">
                        <svg class="w-100 h-auto" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
                        <path fill="currentColor" d="M9.4,18.1c0,3.3,2.7,6,6.1,6c3.3,0,6-2.7,6-6c0-3.3-2.7-6.1-6-6.1C12.1,12.1,9.4,14.8,9.4,18.1z"/>
                        <path fill="currentColor" d="M33.5,5.6C27.1-0.3,17.5-1.4,10,2.9C9,3.5,9.9,5.1,11,4.5c6.1-3.5,13.8-3.2,19.5,1c5.3,3.8,8.2,10.6,7.2,17.1
                            c-0.2,1.4-0.6,2.8-1.1,4.1c-3.5-8.2-13.9-7.3-16.8-1.9c4.7,0.7,7.5,3.9,10.3,10.1c-0.4,0.3-0.8,0.5-1.2,0.8
                            C23.8,21.8,9.9,24.2,5.3,30.2C1.4,24.5,1,17,4.5,10.9C5.1,9.9,3.5,9,3,10c-4.2,7.3-3.4,16.6,2.2,23c4.7,5.4,12.2,7.8,19.2,6.3
                            c7-1.6,12.7-7,14.6-13.9C41,18.3,38.8,10.5,33.5,5.6z"/>
                        <path fill="currentColor" d="M6.6,8.1c0.8,0,1.5-0.7,1.5-1.5c0-0.8-0.7-1.5-1.5-1.5S5.2,5.8,5.2,6.7C5.2,7.5,5.8,8.1,6.6,8.1z"/>
                        <path fill="currentColor" d="M32.5,14.9c0-2.6-2-4.6-4.6-4.6c-2.6,0-4.6,2.1-4.6,4.6c0,2.5,2.1,4.6,4.6,4.6C30.5,19.5,32.5,17.4,32.5,14.9z"
                            />
                        </svg>
                    </i>
                    <span class="d-block fs-4">Ser Anfitrión</span>
                </a>
                <a href="{{route('register-volunteer.create')}}" class="btn btn-lg btn-primary d-flex align-items-center">
                    <i class="btn-icon align-middle me-3">
                        <svg class="w-100 h-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
                        <path fill="currentColor" d="M27.4,18.8c0-4.1-3.3-7.4-7.3-7.4l0,0c-4.1,0-7.3,3.3-7.3,7.3c0,4.1,3.3,7.3,7.3,7.3
                            C24.1,26,27.4,22.8,27.4,18.8z"/>
                        <path fill="currentColor" d="M33.7,5.4C28.2,0.3,20.1-1.4,13,1.2C12,1.6,10.9,2.1,9.9,2.7c-1,0.6-0.1,2.2,0.9,1.6c3.3-1.9,7.1-2.7,10.9-2.4
                            c3.2,0.3,6.3,1.5,8.9,3.4C36,9.1,38.9,16,38,22.5c-0.6,4.1-2.6,7.9-5.6,10.7c-7-8.2-19.3-7-24.7,0.2c-2.3-2.1-4-4.8-5-7.8
                            c-1.3-3.9-1.1-8.2,0.3-12c0.4-0.9,0.8-1.9,1.3-2.7c0.6-1-1-2-1.6-0.9c-2.3,4-3.2,8.7-2.5,13.3c0.6,3.7,2.2,7.2,4.7,10
                            c4.8,5.5,12.4,8,19.5,6.4c7.1-1.6,12.8-7.1,14.8-14.1C41.3,18.3,39.1,10.4,33.7,5.4z"/>
                        <path fill="currentColor" d="M6.5,8C7.3,8,8,7.3,8,6.5C8,5.7,7.3,5,6.5,5C5.6,5,5,5.7,5,6.5C5,7.3,5.6,8,6.5,8z"/>
                        </svg>
                    </i>
                    <span class="d-block fs-4">Ser Voluntario</span>
                </a>
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
