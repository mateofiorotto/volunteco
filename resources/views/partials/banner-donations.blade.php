<!-- Banner de Donaciones -->
<section class="donations-banner-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-white">Ayudanos a seguir <span class="fw-light">creciendo</span></h2>
            <p class="section-subtitle text-white">Tu donación nos permite continuar conectando voluntarios con proyectos
                ecológicos.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="donation-card">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <div class="donation-content">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-heart-fill text-danger fs-3 me-3"></i>
                                    <h3 class="h4 mb-0 text-primary fw-bold">Súmate con tu aporte</h3>
                                </div>

                                <!-- Barra de progreso -->
                                <div class="donation-progress-wrapper mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-bold text-primary">
                                            $4,250.00
                                        </span>
                                        <span class="text-muted small">
                                            Meta: $10,000.00
                                        </span>
                                    </div>
                                    <div class="progress"
                                         style="height: 25px;">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated width-banner-donation"
                                             role="progressbar"
                                             aria-valuenow="42.5"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                            42.5%
                                        </div>
                                    </div>
                                </div>

                                <p class="small text-muted mb-0">
                                    <i class="bi bi-people-fill me-1"></i>
                                    Cada aporte cuenta para seguir conectando voluntarios con proyectos ecológicos en
                                    toda Argentina.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 text-center">
                            <a href="{{ route('donate') }}"
                               class="btn btn-warning btn-lg px-4 py-3 w-100 shadow-sm">
                                <i class="bi bi-heart-fill me-2"></i>
                                Donar ahora
                            </a>
                            <p class="small text-muted mt-3 mb-0">
                                <i class="bi bi-shield-check me-1"></i>
                                Tu donación es segura
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
