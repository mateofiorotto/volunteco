@extends('layouts.app')

@section('content')
<section>
    <div class="container-sm py-5">
        <div class="border rounded-3 p-5">
            <h1 class="h2 text-center mb-3">Ingresar</h1>

            {{-- Alerta de éxito --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Perfecto!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alerta de error de middleware --}}
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" novalidate action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input
                        id="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
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
                    <label for="password" class="form-label">Contraseña</label>

                    <input
                        id="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingresa tu contraseña" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="form-check-input"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember_me" class="form-check-label">
                            <span class="small">Recordarme</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small">
                        ¿Olvidaste tu contraseña?
                    </a>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection
