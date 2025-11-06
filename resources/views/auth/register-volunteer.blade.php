@extends('layouts.app')

@section('content')
<section>
    <div class="container py-5">

        <div class="row mb-5">
            <div class="col-md-7">
                <h1 class="title-h1 h3">Registrate como <span>Voluntario</span></h1>
                <p>Completá todos los datos requeridos para poder crear tu cuenta.</p>
            </div>
        </div>

        {{-- Alerta de errores general --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

    <form method="POST"
          action="{{ route('register-volunteer.store') }}"
          enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos Personales</h2>
                        <p>Completa con tus datos.</p>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo *</label>
                            <input type="text"
                                id="full_name"
                                name="full_name"
                                placeholder="Tu nombre completo"
                                required
                                autocomplete="name"
                                class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}"
                                value="{{ old('full_name') }}"/>
                            @if ($errors->has('full_name'))
                                <p class="text-danger">{{ $errors->first('full_name') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI *</label>
                            <input type="text"
                                id="dni"
                                name="dni"
                                placeholder="Ej: 12345678"
                                inputmode="numeric"
                                required
                                class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}"
                                value="{{ old('dni') }}"/>
                            @if ($errors->has('dni'))
                                <p class="text-danger">{{ $errors->first('dni') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Fecha de nacimiento *</label>
                            <input type="date"
                                id="birthdate"
                                name="birthdate"
                                required
                                class="form-control {{ $errors->has('birthdate') ? 'is-invalid' : '' }}"
                                value="{{ old('birthdate') }}"/>
                            @if ($errors->has('birthdate'))
                                <p class="text-danger">{{ $errors->first('birthdate') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos de Acceso</h2>
                        <p>Completa con los datos que te serviran para acceder al sistema.</p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email"
                                id="email"
                                name="email"
                                placeholder="ejemplo@correo.com"
                                required
                                autocomplete="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="{{ old('email') }}"/>
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña *</label>
                            <input type="password"
                                id="password"
                                name="password"
                                placeholder="Ingresa tu contraseña"
                                required
                                autocomplete="new-password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"/>
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña *</label>
                            <input type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repite tu contraseña"
                                required
                                autocomplete="new-password"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"/>
                            @if ($errors->has('password_confirmation'))
                                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos Profesionales</h2>
                        <p>Completa con tus datos.</p>
                        <div class="mb-3">
                            <label for="educational_level" class="form-label">Nivel Educativo *</label>
                            <select name="educational_level"
                                    id="educational_level"
                                    required
                                    class="form-control {{ $errors->has('educational_level') ? 'is-invalid' : '' }}">
                                <option value=""
                                        disabled
                                        {{ old('educational_level') ? '' : 'selected' }}>Selecciona un nivel educativo</option>
                                <option value="Secundario" {{ old('educational_level') == 'Secundario' ? 'selected' : '' }}>Secundario</option>
                                <option value="Postgrado" {{ old('educational_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado</option>
                                <option value="Terciario" {{ old('educational_level') == 'Terciario' ? 'selected' : '' }}>Terciario</option>
                                <option value="Universitario" {{ old('educational_level') == 'Universitario' ? 'selected' : '' }}>Universitario</option>
                            </select>
                            @if ($errors->has('educational_level'))
                                <p class="text-danger">{{ $errors->first('educational_level') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="profession" class="form-label">Profesión</label>
                            <input type="text"
                                id="profession"
                                name="profession"
                                placeholder="Ej: Ingeniero"
                                class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                                value="{{ old('profession') }}"/>
                            @if ($errors->has('profession'))
                                <p class="text-danger">{{ $errors->first('profession') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos de Contacto</h2>
                        <p>Completa con tus datos.</p>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono *</label>
                            <input type="tel"
                                id="phone"
                                name="phone"
                                placeholder="5491112345678"
                                autocomplete="tel"
                                required
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                value="{{ old('phone') }}"/>
                            @if ($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Residencia *</label>
                            <input type="text"
                                id="location"
                                name="location"
                                required
                                placeholder="Ciudad o provincia"
                                autocomplete="address-level2"
                                class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                value="{{ old('location') }}"/>
                            @if ($errors->has('location'))
                                <p class="text-danger">{{ $errors->first('location') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Redes Sociales</h2>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="url"
                                id="linkedin"
                                name="linkedin"
                                placeholder="https://linkedin.com/in/usuario"
                                class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}"
                                value="{{ old('linkedin') }}"/>
                            @if ($errors->has('linkedin'))
                                <p class="text-danger">{{ $errors->first('linkedin') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url"
                                id="facebook"
                                name="facebook"
                                placeholder="https://facebook.com/usuario"
                                class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                value="{{ old('facebook') }}"/>
                            @if ($errors->has('facebook'))
                                <p class="text-danger">{{ $errors->first('facebook') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url"
                                id="instagram"
                                name="instagram"
                                placeholder="https://instagram.com/usuario"
                                class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                value="{{ old('instagram') }}"/>
                            @if ($errors->has('instagram'))
                                <p class="text-danger">{{ $errors->first('instagram') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Info Extra</h2>
                        <p>Completa con tus datos.</p>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Foto de perfil</label>
                            <p>100x100px - 300x300px. 512KB</p>
                            <input type="file"
                                id="avatar"
                                name="avatar"
                                accept="image/*"
                                class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}"/>
                            @if ($errors->has('avatar'))
                                <p class="text-danger">{{ $errors->first('avatar') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Biografía *</label>
                            <textarea id="biography"
                                    name="biography"
                                    required
                                    placeholder="Contanos sobre vos..."
                                    rows="4"
                                    class="form-control {{ $errors->has('biography') ? 'is-invalid' : '' }}">{{ old('biography') }}</textarea>
                            @if ($errors->has('biography'))
                                <p class="text-danger">{{ $errors->first('biography') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg px-5">Volver</a>
            <button type="submit" class="btn btn-primary btn-lg px-5">Enviar</button>
        </div>

    </form>

    </div>
</section>
@endsection