@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-about"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="text-center">
                <h1 class="hero-title">Sobre <span class="fw-light">Nosotros</span></h1>
                <p class="hero-subtitle">Conectando voluntarios con el cambio ambiental</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="section-title text-primary mb-4">Somos <span class="fw-light">Volunteco</span></h2>
                        <p class="section-subtitle">
                            Volunteco es una plataforma pensada para quienes gustan de compartir experiencias de vida y
                            conocimiento profesional a través de actividades de voluntariado, incentivadas por la ecología y
                            el cuidado ambiental.
                        </p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="32"
                                         height="32"
                                         fill="currentColor"
                                         class="bi bi-bullseye text-primary"
                                         viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10m0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8" />
                                        <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="h5 mb-2">Nuestro objetivo</h3>
                                    <p class="text-muted mb-0">
                                        Desarrollar una web a nivel nacional donde ONGs, organizaciones de investigación,
                                        fundaciones o comunidades puedan publicar sus proyectos de carácter ecológico,
                                        especificando tareas y condiciones.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="32"
                                         height="32"
                                         fill="currentColor"
                                         class="bi bi-diagram-3 text-primary"
                                         viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="h5 mb-2">Nuestro rol</h3>
                                    <p class="text-muted mb-0">
                                        Actuamos como nexo entre organizaciones que necesitan colaboración y personas
                                        motivadas por el voluntariado ecológico, facilitando el registro y postulación a
                                        proyectos verificados.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-primary section-title mb-3">Nuestros <span class="fw-light">Valores</span></h2>
                <p class="section-subtitle">Los pilares que guían nuestro trabajo</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="40"
                                 height="40"
                                 fill="currentColor"
                                 class="bi bi-shield-check text-primary"
                                 viewBox="0 0 16 16">
                                <path
                                      d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                                <path
                                      d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            </svg>
                        </div>
                        <h4 class="h6 mb-2">Confiabilidad</h4>
                        <p class="text-muted small mb-0">Proyectos verificados y seguros</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="40"
                                 height="40"
                                 fill="currentColor"
                                 class="bi bi-hearts text-primary"
                                 viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.931.481c1.627-1.671 5.692 1.254 0 5.015-5.692-3.76-1.626-6.686 0-5.015m6.84 1.794c1.084-1.114 3.795.836 0 3.343-3.795-2.507-1.084-4.457 0-3.343M7.84 7.642c2.71-2.786 9.486 2.09 0 8.358-9.487-6.268-2.71-11.144 0-8.358" />
                            </svg>
                        </div>
                        <h4 class="h6 mb-2">Compromiso</h4>
                        <p class="text-muted small mb-0">Dedicación al impacto ambiental</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="40"
                                 height="40"
                                 fill="currentColor"
                                 class="bi bi-people-fill text-primary"
                                 viewBox="0 0 16 16">
                                <path
                                      d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                        </div>
                        <h4 class="h6 mb-2">Comunidad</h4>
                        <p class="text-muted small mb-0">Construyendo redes sostenibles</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="40"
                                 height="40"
                                 fill="currentColor"
                                 class="bi bi-lightbulb text-primary"
                                 viewBox="0 0 16 16">
                                <path
                                      d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1" />
                            </svg>
                        </div>
                        <h4 class="h6 mb-2">Innovación</h4>
                        <p class="text-muted small mb-0">Soluciones tecnológicas responsables</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
