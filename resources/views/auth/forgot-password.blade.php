@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0 mt-5">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">¿Olvidaste tu contraseña?</h1>

                        <p class="text-muted text-center mb-4">
                            Ingresá tu dirección de email y te enviaremos un enlace para restablecer tu contraseña.
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show"
                                 role="alert">
                                {{ session('success') }}
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email"
                                       class="form-label">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="tu@email.com"
                                       required
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit"
                                        class="btn btn-primary">
                                    Enviar enlace de restablecimiento
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}"
                                   class="text-decoration-none">
                                    Volver al inicio de sesión
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
