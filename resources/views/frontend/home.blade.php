@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Conectá con <span class="fw-light">la Naturaleza</span></h1>
            <p class="hero-subtitle">Unite a proyectos de voluntariado ecológico alrededor de Argentina.</p>
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
                <h2 class="section-title text-white">Experiencias <span class="fw-light">Transformadoras</span></h2>
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
                <h2 class="section-title">Nos <span class="fw-light">Apoyan</span></h2>
                <p class="section-subtitle">Organizaciones comprometidas con el medio ambiente</p>
            </div>

            <div class="d-flex align-items-center justify-content-center gap-5 mb-5">
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
                <a href="#" class="btn btn-outline-primary">Quiero Ser Sponsors</a>
            </div>
        </div>
    </section>

    <!-- Call to action Final -->
    <section class="cta-section py-5">
        <div class="container py-5">
            <div class="text-center">
                <h2 class="section-title mb-4 text-white">Registrate <span class="fw-light">ahora mismo</span></h2>
                <p class="section-subtitle mb-5 text-white">Unite a nuestra comunidad</p>
                <div class="d-flex gap-5 justify-content-center">
                    <div class="text-center">
                        <svg class="d-block mx-auto mb-3" width="100" height="100" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M82.1526 84.2855C65.6115 99.7487 35.846 99.7822 18.501 84.4614C31.8092 65.4297 64.439 61.9367 82.1526 84.2855Z"/>
                        <path d="M50.3263 28.4721C60.41 28.4805 68.601 36.7817 68.5423 46.9258C68.4921 56.9024 60.2844 65.1031 50.3346 65.1114C40.2174 65.1282 31.9845 56.9107 31.9678 46.7834C31.951 36.6645 40.1839 28.4554 50.3179 28.4638L50.3263 28.4721Z"/>
                        <path d="M6.84249 24.6857C0.996591 34.7293 -1.18096 46.4482 0.602956 57.9158C2.03512 67.13 6.15572 75.8166 12.2529 82.8529C24.221 96.6744 43.3249 102.798 61.1222 98.7853C78.9195 94.7729 93.1993 81.0352 98.149 63.637C103.199 45.8702 97.7386 26.1098 84.2294 13.503C70.5192 0.695116 50.2344 -3.50994 32.613 3.08245C29.9078 4.09602 27.2947 5.31901 24.7989 6.75978C22.3031 8.20056 24.5477 12.2213 27.1272 10.7387C35.402 5.95563 44.8911 3.8866 54.3718 4.75777C62.3199 5.48654 70.1088 8.50212 76.6834 13.2182C90.1088 22.8596 97.3785 40.0149 95.0167 56.3158C92.6716 72.5162 81.541 86.7313 66.1557 92.486C58.2746 95.4346 49.5979 96.2388 41.4489 94.6472C33.2998 93.0557 26.0971 89.4956 20.0669 84.1932C13.8944 78.7652 9.25455 71.7707 6.75873 63.9385C3.62641 54.1128 3.90279 43.508 7.52925 33.8498C8.4254 31.4792 9.54768 29.2091 10.8207 27.0144C12.3115 24.4428 8.33327 22.1225 6.84249 24.6857Z"/>
                        <path d="M16.1976 19.9949C18.279 19.9949 19.9664 18.3073 19.9664 16.2255C19.9664 14.1436 18.279 12.456 16.1976 12.456C14.1161 12.456 12.4287 14.1436 12.4287 16.2255C12.4287 18.3073 14.1161 19.9949 16.1976 19.9949Z"/>
                        </svg>
                        <a href="{{ route('register-volunteer.create') }}" class="btn btn-light fw-medium btn-lg">Ser Voluntario</a>
                    </div>
                    <div class="text-center">
                        <svg class="d-block mx-auto mb-3" width="100" height="100" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M92.238 67.2287C86.5295 79.015 88.2821 78.4641 75.5797 87.8798C68.5191 72.0701 61.3751 63.7562 49.4238 61.9699C56.8016 48.3806 83.3914 46.0935 92.238 67.2454V67.2287Z"/>
                        <path d="M38.4744 29.9499C46.9038 29.9499 53.764 36.8948 53.714 45.3923C53.6639 53.7395 46.8036 60.601 38.4911 60.601C30.0284 60.601 23.1348 53.7395 23.1348 45.2754C23.1348 36.8113 30.0117 29.9499 38.4911 29.9499H38.4744Z"/>
                        <path d="M6.74372 24.6245C-3.92228 43.122 -1.81912 66.7781 12.2353 82.9217C24.2366 96.6946 43.2986 102.805 61.0752 98.7981C78.8519 94.7915 93.2735 80.935 98.1809 63.4392C103.155 45.6763 97.6634 25.9601 84.1598 13.3891C68.069 -1.60254 43.7659 -4.24027 24.7207 6.67793C22.1502 8.14704 24.4703 12.137 27.0408 10.6679C42.6142 1.73636 62.0433 2.67125 76.6319 13.1387C90.1522 22.8382 97.3964 39.9667 94.9761 56.4442C92.6059 72.5878 81.4057 86.7948 66.066 92.5043C50.7264 98.2138 32.5658 95.2255 20.0303 84.2071C3.73922 69.9 -0.0998756 45.7096 10.733 26.945C12.2186 24.3741 8.22929 22.0369 6.74372 24.6245Z"/>
                        <path d="M16.1073 19.9165C18.1907 19.9165 19.8796 18.2273 19.8796 16.1436C19.8796 14.0598 18.1907 12.3706 16.1073 12.3706C14.0239 12.3706 12.335 14.0598 12.335 16.1436C12.335 18.2273 14.0239 19.9165 16.1073 19.9165Z"/>
                        <path d="M72.6094 90.4006C41.1956 106.327 16.1079 83.6895 11.8516 76.7779C22.9849 60.8681 60.0572 53.606 72.6094 90.4006Z"/>
                        <path d="M70.1552 25.2421C76.5982 25.2421 81.8227 30.5509 81.7893 37.0284C81.7559 43.4057 76.5147 48.6477 70.1552 48.6477C63.6955 48.6477 58.4376 43.4057 58.4209 36.9449C58.4209 30.4841 63.6621 25.2421 70.1552 25.2421Z"/>
                        </svg>
                        <a href="{{ route('register-host.create') }}" class="btn btn-light fw-medium btn-lg d-flex justify-content-center flex-column gap-3">Ser Anfitrión</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
