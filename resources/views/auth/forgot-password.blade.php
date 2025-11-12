@extends('layouts.app')

@section('content')
<section>
    <div class="container-sm py-5">
        <div class="border rounded-3 p-5">
            <h1 class="h2 text-center mb-3">¿Olvidaste tu contraseña?</h1>
            <p class="text-muted text-center mb-4">
                Ingresá tu dirección de email y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            <form method="POST" novalidate action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="tu@correo.com"
                        required
                        autofocus
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary">
                        Reestablecer mi contraseña
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
