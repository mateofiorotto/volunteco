@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Conecta con la Naturaleza</h1>
            <p class="hero-subtitle">Unite a proyectos de voluntariado ecológico alrededor de Argentina</p>
            <div>
                <a href="{{ route('projects') }}"
                   class="btn btn-primary btn-lg">Explorar Proyectos</a>
            </div>
        </div>
    </section>

    <!-- Últimos Proyectos -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Últimos Proyectos</h2>
            <p class="section-subtitle text-center">Descubrí oportunidades increíbles para hacer la diferencia</p>

            <!-- Lista de proyectos -->
            <div class="projects-list">
                @if ($projects->isEmpty())
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        <h3 class="ff-nunito">No hay proyectos disponibles</h3>
                        <p>Actualmente no hay proyectos publicados. Te invitamos a volver pronto para descubrir nuevas
                            oportunidades de voluntariado.</p>
                        <a href="{{ route('home') }}"
                           class="btn btn-primary">Volver al Inicio</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card project-card">
                                    <div>
                                        <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                             class="card-img-top object-fit-cover"
                                             alt="{{ $project->title }}">
                                        <div class="project-badge-overlay">
                                            <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5 ff-nunito">{{ $project->title }}</h3>

                                        <p class="card-text mb-3 small text-muted">
                                            {{ Str::limit($project->description, 100) }}
                                        </p>

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
                                               class="btn btn-outline-primary w-100">
                                                Ver Detalles
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
        </div>
    </section>

    <!-- Reseñas -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-white">Experiencias Transformadoras</h2>
                <p class="section-subtitle text-white">Lee lo que dicen nuestros voluntarios y anfitriones</p>
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
                            <img src="https://i.pravatar.cc/150?img=5"
                                 alt="María"
                                 class="testimonial-avatar">
                            <div>
                                <strong class="d-block ff-nunito">María González</strong>
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
                            <img src="https://i.pravatar.cc/150?img=12"
                                 alt="Carlos"
                                 class="testimonial-avatar">
                            <div>
                                <strong class="d-block ff-nunito">Carlos Méndez</strong>
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
                            <img src="https://i.pravatar.cc/150?img=28"
                                 alt="Ana"
                                 class="testimonial-avatar">
                            <div>
                                <strong class="d-block ff-nunito">Ana Silva</strong>
                                <small class="text-muted">Voluntaria</small>
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
                <h2 class="section-title">Nos Apoyan</h2>
                <p class="section-subtitle">Organizaciones comprometidas con el medio ambiente</p>
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-3 text-center mb-lg-0 mb-5">
                    <img src="images/wwf-logo.png"
                         alt="WWF"
                         class="sponsor-logo img-fluid">
                </div>
                <div class="col-12 col-md-3 text-center mb-lg-0 mb-5">
                    <img src="images/wwf-logo.png"
                         alt="Greenpeace"
                         class="sponsor-logo img-fluid">
                </div>
                <div class="col-12 col-md-3 text-center mb-5 mb-lg-0">
                    <img src="images/wwf-logo.png"
                         alt="Nature Conservancy"
                         class="sponsor-logo img-fluid">
                </div>
                <div class="col-12 col-md-3 text-center mb-5 mb-lg-0">
                    <img src="images/wwf-logo.png"
                         alt="Conservation"
                         class="sponsor-logo img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action Final -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-4 text-white">¿Estás Listo/a?</h2>
                <p class="section-subtitle mb-4 text-white">Unite a nuestra comunidad</p>
                <a href="{{ route('register-volunteer.create') }}"
                   class="btn btn-light btn-hero px-5 mx-2 mb-3 mb-lg-0">Ser Voluntario</a>
                <a href="{{ route('register-host.create') }}"
                   class="btn btn-light btn-hero px-5 mx-2">Ser Anfitrión</a>
            </div>
        </div>
    </section>
@endsection
