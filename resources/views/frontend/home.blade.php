@extends('layouts.app')

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
                   class="btn btn-primary btn-hero btn-hero-primary">Explorar Proyectos</a>
            </div>
        </div>
    </section>

    <!-- Últimos Proyectos -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Últimos Proyectos</h2>
                <p class="section-subtitle">Descubrí oportunidades increíbles para hacer la diferencia</p>
            </div>

            @if ($projects->isEmpty())
                <p>No hay proyectos publicados actualmente.</p>
            @else
                <div class="row justify-content-center">
                    @foreach ($projects as $project)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . ($project->image ?? 'thumbnail-proyecto.jpg')) }}"
                                         class="card-img-top object-fit-cover"
                                         alt="{{ $project->title }}"
                                         width="304"
                                         height="228">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5">{{ $project->title }}</h3>
                                    <div class="mb-2">
                                        <span class="badge bg-primary">{{ $project->projectType->name }}</span>
                                    </div>

                                    <p class="card-text mb-3 small">
                                        {{ Str::limit($project->description, 100) }}
                                    </p>

                                    <ul class="list-unstyled mt-auto mb-3">

                                        <li class="d-flex gap-2 align-items-start mb-2">
                                            <i class="bi bi-geo-alt fs-5 text-primary"></i>
                                            <span>{{ $project->location_id ? $project->location->name . ' - ' . $project->location->province->name : '' }}</span>
                                        </li>

                                    </ul>

                                    <div>
                                        <a href="{{ route('project', $project->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Reseñas -->
    <section class="testimonials-section py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Experiencias Transformadoras</h2>
                <p class="section-subtitle">Lee lo que dicen nuestros voluntarios y anfitriones</p>
            </div>

            <div class="row g-4">
                <!-- Reseña 1 -->
                <div class="col-md-4">
                    <div class="testimonial-card">
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
                    <div class="testimonial-card">
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
                    <div class="testimonial-card">
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
                <h2 class="section-title mb-4">¿Estás Listo/a?</h2>
                <p class="section-subtitle mb-4">Unite a nuestra comunidad</p>
                <a href="{{ route('register-volunteer.create') }}"
                   class="btn btn-light btn-hero px-5 mx-2 mb-3 mb-lg-0">Ser Voluntario</a>
                <a href="{{ route('register-host.create') }}"
                   class="btn btn-light btn-hero px-5 mx-2">Ser Anfitrión</a>
            </div>
        </div>
    </section>
@endsection
