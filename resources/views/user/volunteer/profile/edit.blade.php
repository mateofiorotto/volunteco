@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">

             <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <h1 class="title-h1 h3">Editar <span>Mi Perfil</span></h1>
                    <p class="mb-3">Completá todos los datos requeridos para actualizar tu perfil.</p>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>

            {{-- Alerta de errores general --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

             <form method="POST" action="{{ route('volunteer.update-my-profile') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    {{-- DATOS PERSONALES --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos Personales</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Nombre Completo *</label>
                                    <input type="text"
                                           id="full_name"
                                           name="full_name"
                                           placeholder="Tu nombre completo"
                                           required
                                           autocomplete="name"
                                           value="{{ old('full_name', $volunteer->full_name) }}"
                                           class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('full_name'))
                                        <p class="text-danger">{{ $errors->first('full_name') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="birthdate" class="form-label">Fecha de nacimiento *</label>
                                    <input type="date"
                                           id="birthdate"
                                           name="birthdate"
                                           value="{{ old('birthdate', $volunteer->birthdate) }}"
                                           required
                                           class="form-control {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('birthdate'))
                                        <p class="text-danger">{{ $errors->first('birthdate') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DATOS DE ACCESO --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Acceso</h2>
                                <p class="mb-3">Completa con los datos que te servirán para acceder al sistema.</p>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           placeholder="Ingresa tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                    <small class="form-text text-muted">Déjalo en blanco si no deseas cambiarla</small>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Repite tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DATOS PROFESIONALES --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos Profesionales</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="mb-3">
                                    <label for="educational_level" class="form-label">Nivel Educativo *</label>
                                    <select name="educational_level"
                                            id="educational_level"
                                            required
                                            class="form-control {{ $errors->has('educational_level') ? 'is-invalid' : '' }}">
                                        <option value="" disabled {{ old('educational_level', $volunteer->educational_level) == '' ? 'selected' : '' }}>
                                            Selecciona un nivel educativo
                                        </option>
                                        <option value="secundario" {{ old('educational_level', $volunteer->educational_level) === 'secundario' ? 'selected' : '' }}>Secundario</option>
                                        <option value="terciario" {{ old('educational_level', $volunteer->educational_level) === 'terciario' ? 'selected' : '' }}>Terciario</option>
                                        <option value="universitario" {{ old('educational_level', $volunteer->educational_level) === 'universitario' ? 'selected' : '' }}>Universitario</option>
                                        <option value="postgrado" {{ old('educational_level', $volunteer->educational_level) === 'postgrado' ? 'selected' : '' }}>Postgrado</option>
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
                                           placeholder="Ej: Ingeniero, Profesor, Diseñador..."
                                           value="{{ old('profession', $volunteer->profession) }}"
                                           class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('profession'))
                                        <p class="text-danger">{{ $errors->first('profession') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DATOS DE CONTACTO --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Contacto</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Teléfono *</label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', $volunteer->phone) }}"
                                           placeholder="Ej: 5491112345678"
                                           autocomplete="tel"
                                           required
                                           class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Residencia *</label>
                                    <input type="text"
                                           id="location"
                                           name="location"
                                           placeholder="Ciudad o provincia"
                                           required
                                           value="{{ old('location', $volunteer->location) }}"
                                           autocomplete="address-level2"
                                           class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('location'))
                                        <p class="text-danger">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- REDES SOCIALES --}}
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
                                           value="{{ old('linkedin', $volunteer->linkedin) }}"
                                           class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" />
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
                                           value="{{ old('facebook', $volunteer->facebook) }}"
                                           class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" />
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
                                           value="{{ old('instagram', $volunteer->instagram) }}"
                                           class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('instagram'))
                                        <p class="text-danger">{{ $errors->first('instagram') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFO EXTRA --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Info Extra</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Foto de perfil</label>
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*"
                                           class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('avatar'))
                                        <p class="text-danger">{{ $errors->first('avatar') }}</p>
                                    @endif

                                    <p class="pt-3 pb-3">Foto de perfil actual:</p>
                                    <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                         alt="Foto de perfil de {{ $volunteer->full_name }}"
                                         class="mt-3 mb-3 rounded-circle img-fluid object-fit-cover avatar-md">
                                </div>

                                <div class="mb-3">
                                    <label for="biography" class="form-label">Biografía *</label>
                                    <textarea id="biography"
                                              name="biography"
                                              required
                                              placeholder="Contanos sobre vos..."
                                              rows="4"
                                              class="form-control {{ $errors->has('biography') ? 'is-invalid' : '' }}">{{ old('biography', $volunteer->biography) }}</textarea>
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
                    <button type="submit" class="btn btn-primary btn-lg px-5">Actualizar</button>
                </div>

            </form>

        </div>
    </section>
@endsection
