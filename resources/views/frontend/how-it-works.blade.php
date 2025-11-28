@extends('layouts.app')

@section('title', 'Cómo funciona')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-how-it-works"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="text-center">
                <h1 class="hero-title">¿Cómo <span class="fw-light">funciona</span>?</h1>
                <p class="hero-subtitle">Sin complicaciones y totalmente confiable</p>
            </div>
        </div>
    </section>
    <section class="how-section bg-body-tertiary">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title text-primary">Simples <span class="fw-light">pasos</span></h2>
                <p class="section-subtitle">Comenzá tu aventura como anfitrión o voluntario</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-item d-flex align-items-start gap-4">
                        <div class="step-number"><span>1</span></div>
                        <div class="step-content">
                            <h3 class="step-title">Creá tu perfil</h3>
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
                            <h3 class="step-title">Viví la experiencia</h3>
                            <p class="step-text text-muted">Entre todos ayudamos a crear un mundo mejor.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-5">
                <a href="{{ route('register-host.create') }}"
                   class="btn btn-lg btn-primary d-flex align-items-center">
                    <i class="btn-icon text-white align-middle me-3">
                        <svg class="w-100 h-auto"
                             version="1.1"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px"
                             y="0px"
                             width="40px"
                             height="40px"
                             viewBox="0 0 40 40"
                             style="enable-background:new 0 0 40 40;"
                             xml:space="preserve">
                            <path fill="#FFFFFF"
                                  d="M9.4,18.1c0,3.3,2.7,6,6.1,6c3.3,0,6-2.7,6-6c0-3.3-2.7-6.1-6-6.1C12.1,12.1,9.4,14.8,9.4,18.1z" />
                            <path fill="#FFFFFF"
                                  d="M33.5,5.6C27.1-0.3,17.5-1.4,10,2.9C9,3.5,9.9,5.1,11,4.5c6.1-3.5,13.8-3.2,19.5,1c5.3,3.8,8.2,10.6,7.2,17.1
                                c-0.2,1.4-0.6,2.8-1.1,4.1c-3.5-8.2-13.9-7.3-16.8-1.9c4.7,0.7,7.5,3.9,10.3,10.1c-0.4,0.3-0.8,0.5-1.2,0.8
                                C23.8,21.8,9.9,24.2,5.3,30.2C1.4,24.5,1,17,4.5,10.9C5.1,9.9,3.5,9,3,10c-4.2,7.3-3.4,16.6,2.2,23c4.7,5.4,12.2,7.8,19.2,6.3
                                c7-1.6,12.7-7,14.6-13.9C41,18.3,38.8,10.5,33.5,5.6z" />
                            <path fill="#FFFFFF"
                                  d="M6.6,8.1c0.8,0,1.5-0.7,1.5-1.5c0-0.8-0.7-1.5-1.5-1.5S5.2,5.8,5.2,6.7C5.2,7.5,5.8,8.1,6.6,8.1z" />
                            <path fill="#FFFFFF"
                                  d="M32.5,14.9c0-2.6-2-4.6-4.6-4.6c-2.6,0-4.6,2.1-4.6,4.6c0,2.5,2.1,4.6,4.6,4.6C30.5,19.5,32.5,17.4,32.5,14.9z" />
                        </svg>
                    </i>
                    <span class="d-block fs-4">Ser anfitrión</span>
                </a>
                <a href="{{ route('register-volunteer.create') }}"
                   class="btn btn-lg btn-primary d-flex align-items-center">
                    <i class="btn-icon text-white align-middle me-3">
                        <svg class="w-100 h-auto"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px"
                             y="0px"
                             width="40px"
                             height="40px"
                             viewBox="0 0 40 40"
                             style="enable-background:new 0 0 40 40;"
                             xml:space="preserve">
                            <path fill="#FFFFFF"
                                  d="M27.4,18.8c0-4.1-3.3-7.4-7.3-7.4l0,0c-4.1,0-7.3,3.3-7.3,7.3c0,4.1,3.3,7.3,7.3,7.3
                                C24.1,26,27.4,22.8,27.4,18.8z" />
                            <path fill="#FFFFFF"
                                  d="M33.7,5.4C28.2,0.3,20.1-1.4,13,1.2C12,1.6,10.9,2.1,9.9,2.7c-1,0.6-0.1,2.2,0.9,1.6c3.3-1.9,7.1-2.7,10.9-2.4
                                c3.2,0.3,6.3,1.5,8.9,3.4C36,9.1,38.9,16,38,22.5c-0.6,4.1-2.6,7.9-5.6,10.7c-7-8.2-19.3-7-24.7,0.2c-2.3-2.1-4-4.8-5-7.8
                                c-1.3-3.9-1.1-8.2,0.3-12c0.4-0.9,0.8-1.9,1.3-2.7c0.6-1-1-2-1.6-0.9c-2.3,4-3.2,8.7-2.5,13.3c0.6,3.7,2.2,7.2,4.7,10
                                c4.8,5.5,12.4,8,19.5,6.4c7.1-1.6,12.8-7.1,14.8-14.1C41.3,18.3,39.1,10.4,33.7,5.4z" />
                            <path fill="#FFFFFF"
                                  d="M6.5,8C7.3,8,8,7.3,8,6.5C8,5.7,7.3,5,6.5,5C5.6,5,5,5.7,5,6.5C5,7.3,5.6,8,6.5,8z" />
                        </svg>
                    </i>
                    <span class="d-block fs-4">Ser voluntario</span>
                </a>
            </div>
        </div>
    </section>
@endsection
