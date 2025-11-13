@extends('layouts.app')

@section('content')
<section>
    <div class="container-sm py-5">
        <div class="border rounded-3 p-5">

            <h1 class="h2 text-center mb-3">Restablecer contraseña</h1>
            <p class="text-muted text-center mb-4">Ingresá tu nueva contraseña</p>

            {{-- Alerta de éxito --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alerta de error --}}
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>¡Atención!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alerta de errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error.</strong> Por favor, verificá los datos ingresados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" novalidate action="{{ route('password.store') }}">
                @csrf

                <!-- Token de reset (oculto) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="ejemplo@correo.com"
                    />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Ingresá tu nueva contraseña"
                    />
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirmá tu nueva contraseña"
                    />
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @enderror
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary">
                        Restablecer contraseña
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="small">
                        Volver al inicio de sesión
                    </a>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
