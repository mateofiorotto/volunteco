@extends('layouts.app')

@section('content')
<section>
    <div class="container my-auto h-100 align-items-center d-flex justify-content-center">
        
        <div class="py-5">
            <h1 class="h2 text-center mb-3">Ingresar</h1>

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

            {{-- Alerta de error general --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    <p><strong>Error de autenticación.</strong> Por favor, verificá tus credenciales.</p>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email"
                           class="form-label">Correo electrónico</label>
                    <input id="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           placeholder="ejemplo@correo.com" />
                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password"
                           class="form-label">Contraseña</label>

                    <input id="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Ingresa tu contraseña" />
                    @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="mb-3 form-check">
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

                <div class="d-flex align-items-center justify-content-center mt-4 gap-3 flex-col">
                    <button type="submit"
                            class="btn btn-primary">Ingresar</button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="small">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
@endsection