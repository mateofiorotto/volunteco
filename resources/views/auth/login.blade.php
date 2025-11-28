@extends('layouts.app')

@section('content')
    <section>
        <div class="container-sm py-5">
            <div class="border rounded-3 p-5 px-md-5 px-3">
                <h1 class="h2 text-center mb-5">Ingresar</h1>

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

                {{-- Alerta de error de middleware --}}
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

                <form method="POST" class="mb-5" novalidate action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email"
                               class="form-label">Correo electrónico</label>
                        <input id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="ejemplo@correo.com" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password"
                               class="form-label">Contraseña</label>

                        <input id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="Ingresá tu contraseña" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="form-check mb-4 ">
                            <input id="remember_me"
                                   type="checkbox"
                                   class="form-check-input"
                                   name="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember_me"
                                   class="form-check-label">
                                <span class="small">Recordarme</span>
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="small mb-4 text-decoration-underline">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                    </div>

                </form>

                <div class="text-center">
                    <p class="form-text mb-2">¿Aún no tenés cuenta?</p>
                    <p class="form-text mb-0">Podés registrarte como <a href="{{route('register-host.create')}}" class="text-decoration-underline">anfitrión</a> o como <a href="{{route('register-volunteer.create')}}" class="text-decoration-underline">voluntario</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
