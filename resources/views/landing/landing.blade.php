<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Volunteco - Cambia el Mundo, Una Acción a la Vez</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --primary: #66800A;
            --primary-dark: #223F05;
            --secondary: #EC5228;
            --light: #FEFAE0;
            --body-color: #1E1E1E;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Noto Sans", sans-serif;
            color: var(--body-color);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Nunito', sans-serif;
        }

        .landing-hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-video-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        .hero-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
                    rgba(102, 128, 10, 0.7) 0%,
                    rgba(34, 63, 5, 0.8) 100%),
                url('images/landing.jpeg') center/cover;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-logo {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 3px;
            margin-bottom: 2rem;
            text-transform: uppercase;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 3rem;
            line-height: 1.6;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-landing {
            padding: 18px 50px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-landing-primary {
            background: white;
            color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-landing-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            color: var(--primary-dark);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            40% {
                transform: translateX(-50%) translateY(-10px);
            }

            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        .scroll-indicator svg {
            width: 30px;
            height: 30px;
            color: white;
            opacity: 0.8;
        }

        /* Stats Section */
        .stats-section {
            background: var(--primary);
            color: white;
            padding: 80px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            margin-bottom: 10px;
            line-height: 1;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(to bottom, white 0%, var(--light) 100%);
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--body-color);
        }

        .section-subtitle {
            font-size: 1.3rem;
            text-align: center;
            color: #6b7280;
            margin-bottom: 60px;
            font-weight: 300;
        }

        .feature-card {
            text-align: center;
            padding: 40px 30px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .feature-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--body-color);
        }

        .feature-text {
            color: #6b7280;
            line-height: 1.7;
        }

        /* How it Works */
        .how-section {
            padding: 100px 0;
            background: white;
        }

        .step-item {
            position: relative;
            padding: 30px;
            margin-bottom: 40px;
        }

        .step-number {
            position: absolute;
            left: -20px;
            top: 20px;
            width: 60px;
            height: 60px;
            background: var(--secondary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            box-shadow: 0 5px 15px rgba(236, 82, 40, 0.3);
        }

        .step-content {
            margin-left: 60px;
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--body-color);
        }

        .step-text {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            opacity: 0.3;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        .btn-landing-white {
            background: white;
            color: var(--primary);
        }

        .btn-landing-white:hover {
            background: var(--light);
            color: var(--primary-dark);
        }

        /* Footer */
        .landing-footer {
            background: var(--body-color);
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .landing-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .landing-footer a:hover {
            color: white;
        }

        .hero-img {
            max-width: 200px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .btn-landing {
                padding: 15px 35px;
                font-size: 1rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2.2rem;
            }

            .step-number {
                position: relative;
                left: 0;
                margin: 0 auto 20px;
            }

            .step-content {
                margin-left: 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="landing-hero">
        <div class="hero-bg-image"></div>
        <div class="hero-content">
            <div class="hero-logo">
                <img class="img-fluid hero-img"
                     src="images/logo-white.svg"
                     alt="Logo">
            </div>
            <h1 class="hero-title">Cambia el Mundo, Una Acción a la Vez</h1>
            <p class="hero-subtitle">
                Únete a la comunidad de voluntarios y anfitriones comprometidos con la conservación del planeta.
                Tu aventura comienza aquí.
            </p>
            <a href="{{ route('home') }}"
               class="btn-landing btn-landing-primary">
                Explorar Ahora
            </a>
        </div>
        <div class="scroll-indicator">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="2"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Proyectos Activos</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">1K+</div>
                        <div class="stat-label">Voluntarios</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Satisfacción</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">¿Por Qué Elegirnos?</h2>
            <p class="section-subtitle">Tu plataforma de confianza para voluntariado ecológico</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Proyectos Nacionales</h3>
                        <p class="feature-text">Accedé o publicá proyectos de voluntariado ecológico en toda la República Argentina.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">100% Verificado</h3>
                        <p class="feature-text">Todos nuestros proyectos y anfitriones están verificados. Tu seguridad y
                            experiencia son nuestra prioridad.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Impacto Real</h3>
                        <p class="feature-text">Tu trabajo genera un impacto medible. Recibe certificados y reportes de
                            tu contribución al medio ambiente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-section">
        <div class="container">
            <h2 class="section-title">¿Cómo Funciona?</h2>
            <p class="section-subtitle">Comenzá tu aventura en 4 simples pasos</p>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Crea tu Perfil</h3>
                            <p class="step-text">Regístrate gratis como voluntario o anfitrión, solo toma unos minutos.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Proyectos</h3>
                            <p class="step-text">Si sos anfitrión podes crear proyectos de voluntariado ecológico. Si sos voluntario podes aplicar para ayudar en ellos.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Conectá</h3>
                            <p class="step-text">Podés conectar con otros usuarios de la plataforma una vez te involucres en un proyecto.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3 class="step-title">Vivi la Experiencia</h3>
                            <p class="step-text">Entre todos ayudamos a crear un mundo mejor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Tu Aventura Te Está Esperando</h2>
                <p class="cta-subtitle">Unite a la comunidad y deja tu huella</p>
                <a href="{{ route('home') }}"
                   class="btn-landing btn-landing-white">
                    Comenzar Ahora
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <div class="container">
            <p class="mb-0">© 2025 Volunteco. Todos los derechos reservados. | <a href="{{ route('home') }}">Ir a la
                    Plataforma</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
