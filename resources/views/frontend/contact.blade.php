@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-contact"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="text-center">
                <h1 class="hero-title">Envía<span class="fw-light"> tu mensaje</span></h1>
                <p class="hero-subtitle">Estamos para ayudarte y responder tus consultas</p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="border rounded-3 p-5 px-md-5 px-3">
                        <h2 class="section-title text-primary text-center mb-4">Envianos tu mensaje</h2>
                        <p class="text-center section-subtitle mb-5">Completá el formulario y nos pondremos en contacto a la
                            brevedad</p>

                        {{-- Alerta de éxito --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show"
                                 role="alert">
                                <strong>¡Perfecto!</strong> {{ session('success') }}
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Alerta de error --}}
                        @if (session('error'))
                            <div class="alert alert-warning alert-dismissible fade show"
                                 role="alert">
                                {{ session('error') }}
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="GET"
                              novalidate
                              action="#">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name"
                                           class="form-label">Nombre completo</label>
                                    <input id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           type="text"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus
                                           placeholder="Tu nombre" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email"
                                           class="form-label">Correo electrónico</label>
                                    <input id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           placeholder="ejemplo@correo.com" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subject"
                                       class="form-label">Asunto</label>
                                <input id="subject"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       type="text"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       required
                                       placeholder="¿Sobre qué querés consultarnos?" />
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="message"
                                       class="form-label">Mensaje</label>
                                <textarea id="message"
                                          class="form-control @error('message') is-invalid @enderror"
                                          name="message"
                                          rows="4"
                                          required
                                          placeholder="Contanos tu consulta o mensaje...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-primary btn-lg mt-3">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to action Final -->
    <section class="contact-footer py-5">
        <div class="container py-">
            <div class="text-center">
                <h2 class="section-title text-white">Gracias <span class="fw-light">por confiar</span></h2>
    </section>

@endsection
