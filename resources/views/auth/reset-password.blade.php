@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-auto h-100 align-items-center d-flex justify-content-center">

            <div class="py-5">
                <h1 class="h2 text-center mb-3">Restablecer contraseña</h1>
                <p class="text-muted text-center mb-4">Ingresá tu nueva contraseña</p>

                {{-- Alerta de éxito --}}
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

                {{-- Alerta de error --}}
                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show"
                         role="alert">
                        <strong>¡Atención!</strong> {{ session('error') }}
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alerta de errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show"
                         role="alert">
                        <strong>Error.</strong> Por favor, verificá los datos ingresados.
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('password.store') }}">
                    @csrf

                    <!-- Token de reset (oculto) -->
                    <input type="hidden"
                           name="token"
                           value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email"
                               class="form-label">Correo electrónico</label>
                        <input id="email"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               type="email"
                               name="email"
                               value="{{ old('email', $request->email) }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="ejemplo@correo.com" />
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password"
                               class="form-label">Nueva contraseña</label>
                        <input id="password"
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               type="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               placeholder="Ingresá tu nueva contraseña" />
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="mb-3">
                        <label for="password_confirmation"
                               class="form-label">Confirmar contraseña</label>
                        <input id="password_confirmation"
                               class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               placeholder="Confirmá tu nueva contraseña" />
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center justify-content-center mt-4 gap-3 flex-col">
                        <button type="submit"
                                class="btn btn-primary">
                            Restablecer contraseña
                        </button>
                        <a href="{{ route('login') }}"
                           class="small">
                            Volver al inicio de sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
