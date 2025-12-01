@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="hero-title">Conectá con <span class="fw-light">la naturaleza</span></h1>
            <p class="hero-subtitle">Unite a proyectos de voluntariado ecológico alrededor de Argentina.</p>
            <div>
                <a href="{{ route('projects') }}" class="btn btn-primary btn-lg">Explorar proyectos</a>
            </div>
        </div>
    </section>

    <!-- Últimos Proyectos -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center text-primary">Últimos <span class="fw-light">proyectos</span></h2>
            <p class="section-subtitle text-center">Descubrí oportunidades increíbles para hacer la diferencia.</p>

            <!-- Lista de proyectos -->
            <div class="projects-list mb-5">
                @if ($projects->isEmpty())
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        <h3>No hay proyectos disponibles</h3>
                        <p>Actualmente no hay proyectos publicados. Te invitamos a volver pronto para descubrir nuevas oportunidades de voluntariado.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card project-card">
                                    <div>
                                        <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" width="414" height="232">
                                        <div class="project-badge-overlay">
                                            <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5">{{ $project->title }}</h3>

                                        <p class="card-text mb-3 small text-muted">{{ Str::limit($project->description, 100) }}</p>

                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mb-3 text-muted small">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     width="18"
                                                     height="18"
                                                     class="text-primary me-2">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                </svg>
                                                <span>{{ $project->location_id ? $project->location->name . ', ' . $project->location->province->name : 'Ubicación por definir' }}</span>
                                            </div>

                                            <a href="{{ route('project', $project->id) }}"
                                               class="btn btn-azul w-100">
                                                Ver detalles
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="2"
                                                     stroke="currentColor"
                                                     width="16"
                                                     height="16"
                                                     style="display: inline; margin-left: 5px;">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{route('projects')}}" class="btn mx-auto btn-warning">Ver todos</a>
            </div>
        </div>
    </section>

    <!-- Reseñas -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-white">Experiencias <span class="fw-light">transformadoras</span></h2>
                <p class="section-subtitle text-white">Testimonios de quienes forman nuestra comunidad.</p>
            </div>

            <div class="row g-4">
                <!-- Reseña 1 -->
                <div class="col-md-4">
                    <div class="testimonial-card text-body">
                        <div class="testimonial-stars">
                            ★★★★★
                        </div>
                        <p class="mb-0">"Una experiencia inolvidable. Aprendí muchísimo sobre conservación marina y
                            conocí personas increíbles de todo el mundo. El equipo de la reserva fue muy acogedor y
                            profesional."</p>
                        <div class="testimonial-author">
                            <img src="{{asset('images/avatars/nedith-faro-sm.jpg')}}" alt="Camila Rojas" class="testimonial-avatar">
                            <div>
                                <strong class="d-block ff-nunito">Camila Rojas</strong>
                                <small class="text-muted">Voluntaria</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reseña 2 -->
                <div class="col-md-4">
                    <div class="testimonial-card text-body">
                        <div class="testimonial-stars">
                            ★★★★★
                        </div>
                        <p class="mb-0">"Los voluntarios que recibimos fueron maravillosos. Aportaron mucha energía y
                            nuevas ideas a nuestro proyecto de reforestación. Es inspirador ver jóvenes tan comprometidos."
                        </p>
                        <div class="testimonial-author">
                            <img src="{{asset('images/avatars/fireo.jpg')}}" alt="Fireo" class="testimonial-avatar object-fit-contain border-secondary">
                            <div>
                                <strong class="d-block ff-nunito">Fireo</strong>
                                <small class="text-muted">Anfitrión</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reseña 3 -->
                <div class="col-md-4">
                    <div class="testimonial-card text-body">
                        <div class="testimonial-stars">
                            ★★★★★
                        </div>
                        <p class="mb-0">"Mi vida cambió después de este voluntariado. No solo ayudé al medio ambiente,
                            sino que también crecí como persona. Recomiendo esta experiencia a cualquiera que busque
                            propósito."</p>
                        <div class="testimonial-author">
                            <img src="{{asset('images/avatars/blitzboy.jpg')}}" alt="Fernando Pérez" class="testimonial-avatar">
                            <div>
                                <strong class="d-block ff-nunito">Fernando Pérez</strong>
                                <small class="text-muted">Voluntario</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Empresas que nos apoyan -->
    <section class="sponsors-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-primary">Nos <span class="fw-light">apoyan</span></h2>
                <p class="section-subtitle">Organizaciones comprometidas con el medio ambiente.</p>
            </div>

            <div class="d-md-flex align-items-center justify-content-center gap-5 mb-5">
                <div class="text-center mb-5 mb-lg-0 px-3">
                    <img src="{{asset('images/sponsors/temaiken-bioparque.svg')}}" alt="Temaiken" width="130" height="130" class="sponsor-logo object-fit-contain">
                </div>
                <div class="text-center mb-lg-0 mb-5 px-3">
                    <img src="{{asset('images/sponsors/vida.jpg')}}" width="130" height="130" alt="fundación vida silvestre" class="sponsor-logo object-fit-contain">
                </div>
                <div class="text-center mb-lg-0 mb-5 px-3">
                    <img src="{{asset('images/sponsors/logo-azara-color-280.svg')}}"  width="130" height="130" alt="fundación azara" class="sponsor-logo object-fit-contain d-block">
                </div>
                <div class="text-center mb-5 mb-lg-0 px-3">
                    <img src="{{asset('images/sponsors/CeIBA_largo2-768x224.png')}}"  width="130" height="130" alt="Ceiba" class="sponsor-logo object-fit-contain">
                </div>
                <div class="text-center mb-5 mb-lg-0 px-3">
                    <img src="{{asset('images/sponsors/logo-1-1.png')}}" width="130" height="130" alt="Guiráoga" class="sponsor-logo object-fit-contain">
                </div>
            </div>

            <div class="text-center small">
                <a href="{{route('donate')}}" class="btn btn-warning">Quiero ser sponsor</a>
            </div>
        </div>
    </section>

    @include('partials.banner-register')
@endsection
