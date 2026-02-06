@extends('layouts.app')

@section('title', 'Donar')

@section('content')
    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-background-donations"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="text-center">
                <h1 class="hero-title">Aportá <span class="fw-light">tu ayuda</span></h1>
                <p class="hero-subtitle">Tu donación ayuda a proteger el medio ambiente.</p>
            </div>
        </div>
    </section>

    <!-- Donaciones -->
    <section class="py-5">
        <div class="container">
            <div class="text-center row mb-5">
                <div class="col-md-7 mx-auto">
                    <h2 class="section-title text-primary">Colaborá <span class="fw-light">con nosotros</span></h2>
                    <p>Cada aporte hace la diferencia. Tu donación nos ayuda a mantener la plataforma activa y a seguir
                        conectando voluntarios con proyectos ecológicos en toda Argentina.</p>
                </div>
            </div>

            <div class="row justify-content-between align-items-start">
                <!-- Donation Info -->
                <div class="col-lg-5 col-12">
                    <div class="border rounded-3 p-4 mb-4">
                        <h3 class="h5 mb-3">Datos bancarios</h3>

                        <div class="mb-3">
                            <p class="text-muted small mb-1">CBU</p>
                            <div class="d-flex align-items-center">
                                <code class="flex-grow-1 p-2 rounded"
                                      style="background-color: rgba(102, 128, 10, 0.1);">0000003100010234567890</code>
                                <button class="btn btn-sm btn-outline-primary ms-2"
                                        data-copy="0000003100010234567890"
                                        title="Copiar CBU">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="16"
                                         height="16"
                                         fill="currentColor"
                                         class="bi bi-clipboard"
                                         viewBox="0 0 16 16">
                                        <path
                                              d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                        <path
                                              d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="text-muted small mb-1">Alias</p>
                            <div class="d-flex align-items-center">
                                <code class="flex-grow-1 p-2 rounded"
                                      style="background-color: rgba(102, 128, 10, 0.1);">volunteco.donaciones</code>
                                <button class="btn btn-sm btn-outline-primary ms-2"
                                        data-copy="volunteco.donaciones"
                                        title="Copiar Alias">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="16"
                                         height="16"
                                         fill="currentColor"
                                         class="bi bi-clipboard"
                                         viewBox="0 0 16 16">
                                        <path
                                              d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                        <path
                                              d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="form-label text-muted small mb-1">Titular</label>
                            <p class="mb-0"><strong>Volunteco</strong></p>
                        </div>
                    </div>

                    <!-- QR -->
                    <div class="text-center border rounded-3 p-4">
                        <p class="text-muted small mb-3">O escaneá el código QR</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=0000003100010234567890"
                             alt="QR Code"
                             class="img-fluid d-block m-auto my-4"
                             style="max-width: 160px;">
                        <p class="text-muted small mt-3 mb-0">Transferencia inmediata</p>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?w=800&h=1000&fit=crop"
                         alt="Voluntarios cuidando el medio ambiente"
                         class="img-fluid d-block m-auto rounded-3">
                </div>
            </div>

            <!-- Banner de Seguridad -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="bg-primary p-4 text-light rounded-3"
                         role="alert">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center">
                                <i class="bi bi-shield-check display-4"></i>
                            </div>
                            <div class="col-md-11">
                                <h3 class="alert-heading mb-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Tu donación es segura
                                </h3>
                                <p class="mb-2">Todas las transferencias bancarias están protegidas por el sistema de
                                    seguridad bancaria de Argentina y cumplen con los estándares de protección de
                                    datos.</p>
                                <hr class="my-2">
                                <p class="mb-0 small">
                                    <i class="bi bi-lock-fill me-1"></i>
                                    <strong>Conexión encriptada SSL/TLS</strong> - Tus datos están protegidos.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-body-tertiary">
        <div class="container">
            <!-- Impacto -->
            <div class="row mt-5 pb-3">
                <div class="col-12">
                    <h3 class="text-center mb-5 text-primary section-title">Tu ayuda <span class="fw-light">impacta</span>
                    </h3>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="35"
                             height="35"
                             fill="currentColor"
                             class="bi bi-globe-americas"
                             viewBox="0 0 16 16">
                            <path
                                  d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                        </svg>
                    </div>
                    <h4 class="mb-2 text-primary">Mantenimiento de la plataforma</h4>
                    <p class="text-muted">Hosting, desarrollo y mejoras continuas</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <i class="bi bi-people"
                           style="font-size: 35px;"></i>
                    </div>
                    <h4 class="mb-2 text-primary">Apoyo a organizaciones</h4>
                    <p class="text-muted">Ayudamos a difundir proyectos locales</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-azul text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <i class="bi bi-tree"
                           style="font-size: 35px;"></i>
                    </div>
                    <h4 class="mb-2 text-primary">Impacto ambiental</h4>
                    <p class="text-muted">Más voluntarios, más acciones positivas</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Funcionalidad de copiar al portapapeles
            document.querySelectorAll('button[data-copy]').forEach(button => {
                button.addEventListener('click', function() {
                    const textToCopy = this.getAttribute('data-copy');
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        // Feedback visual
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-check2"></i>';
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-success');

                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.classList.remove('btn-success');
                            this.classList.add('btn-outline-primary');
                        }, 2000);
                    });
                });
            });
        });
    </script>
@endsection
