@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-about"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="text-center">
                <h1 class="hero-title">Sobre <span class="fw-light">nosotros</span></h1>
                <p class="hero-subtitle">Conectando voluntarios con el cambio ambiental.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-5">
                        <h2 class="section-title text-primary mb-4">Somos <span class="fw-semibold">Volunt<span class="fw-light">eco</span></span></h2>
                        <p class="section-subtitle">
                            <span class="text-volunteco">Volunt<span>eco</span></span> es una plataforma pensada para quienes gustan de compartir experiencias de vida y
                            conocimiento profesional a través de actividades de voluntariado, incentivadas por la ecología y
                            el cuidado ambiental.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mb-5 align-items-center">
                <div class="col-md-5 mx-auto order-md-last order-first">
                    <div class="d-flex align-items-start mb-4">
                        <div class="flex-shrink-0 me-3">
                            <div class="icono text-white bg-primary rounded-circle p-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        fill="currentColor"
                                        class="bi bi-bullseye"
                                        viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10m0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8" />
                                    <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3">
                            <h3>Nuestro objetivo</h3>
                            <p class="text-muted">
                                Desarrollar una web a nivel nacional donde ONGs, organizaciones de investigación,
                                fundaciones o comunidades puedan publicar sus proyectos de carácter ecológico,
                                especificando tareas y condiciones.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <div class="icono text-white bg-primary rounded-circle p-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                    width="32"
                                    height="32"
                                    fill="currentColor"
                                    class="bi bi-diagram-3"
                                    viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                        d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5z" />
                            </svg>
                            </div>
                        </div>
                        <div class="pt-3">
                            <h3>Nuestro rol</h3>
                            <p class="text-muted mb-0">
                                Actuamos como nexo entre organizaciones que necesitan colaboración y personas
                                motivadas por el voluntariado ecológico, facilitando el registro y postulación a
                                proyectos verificados.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <img src="{{asset('images/voluntariado.png')}}" width="550" height="512" alt="Voluntariado" class="img-fluid"/>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="bg-primary py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="h-100 border rounded-3 p-4 bg-white">
                        <div class="d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="28"
                                 height="28"
                                 fill="currentColor"
                                 class="bi bi-compass text-primary me-2"
                                 viewBox="0 0 16 16">
                                <path
                                      d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016m6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0" />
                                <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z" />
                            </svg>
                            <h3 class="h4 mb-0">Misión</h3>
                        </div>
                        <p class="text-muted mb-0">
                            Conectar personas motivadas por el voluntariado y la ecología con proyectos locales que
                            necesiten colaboración. Proporcionar una web segura, confiable y responsable que fomente el
                            intercambio de conocimientos y experiencias, la conciencia ambiental y la construcción de
                            comunidades sostenibles.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 border rounded-3 p-4 bg-white">
                        <div class="d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="28"
                                 height="28"
                                 fill="currentColor"
                                 class="bi bi-eye text-primary me-2"
                                 viewBox="0 0 16 16">
                                <path
                                      d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                <path
                                      d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                            </svg>
                            <h3 class="h4 mb-0">Visión</h3>
                        </div>
                        <p class="text-muted mb-0">
                            Ser la plataforma líder a nivel nacional en voluntariados de nicho ecológico. Promover la
                            participación responsable y consciente en proyectos que generen un impacto positivo en el medio
                            ambiente y en las comunidades, inspirando a más personas a involucrarse en la construcción de un
                            futuro sostenible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="pt-5 pb-3 bg-body-tertiary">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-primary section-title">Nuestros <span class="fw-light">valores</span></h2>
                <p class="section-subtitle">Los pilares que guían nuestro trabajo.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="text-center">
                        <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-check" style="font-size: 35px;"></i>
                        </div>
                        <h4 class="mb-2 text-primary">Confiabilidad</h4>
                        <p class="text-muted mb-0">Proyectos verificados y seguros</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="text-center">
                        <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px; padding-top: 6px;">
                            <i class="bi bi-heart" style="font-size: 35px;"></i>
                        </div>
                        <h4 class="mb-2 text-primary">Compromiso</h4>
                        <p class="text-muted mb-0">Dedicación al impacto ambiental</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="text-center">
                        <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <i class="bi bi-people" style="font-size: 35px;"></i>
                        </div>
                        <h4 class="mb-2 text-primary">Comunidad</h4>
                        <p class="text-muted mb-0">Construyendo redes sostenibles</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="text-center">
                        <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <i class="bi bi-lightbulb" style="font-size: 35px;"></i>
                        </div>
                        <h4 class="mb-2 text-primary">Innovación</h4>
                        <p class="text-muted mb-0">Soluciones tecnológicas responsables</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
