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

             <form method="POST" novalidate action="{{ route('volunteer.my-profile.update', $volunteer->user_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    {{-- DATOS PERSONALES --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos Personales</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Nombre *</label>
                                        <input type="text"
                                            id="name"
                                            name="name"
                                            placeholder="Nombre"
                                            required
                                            autocomplete="name"
                                            value="{{ old('name', $volunteer->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" />
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastname" class="form-label">Apellido *</label>
                                        <input type="text"
                                            id="lastname"
                                            name="lastname"
                                            placeholder="Apellido"
                                            required
                                            autocomplete="lastname"
                                            value="{{ old('lastname', $volunteer->lastname) }}"
                                            class="form-control @error('lastname') is-invalid @enderror" />
                                        @if ($errors->has('lastname'))
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="dni" class="form-label">DNI *</label>
                                        <input type="text"
                                            id="dni"
                                            name="dni"
                                            placeholder="12345678"
                                            inputmode="numeric"
                                            disabled
                                            class="form-control @error('dni') is-invalid @enderror"
                                            value="{{ old('dni') }}"/>
                                            @error('dni')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="birthdate" class="form-label">Fecha de nacimiento *</label>
                                        <input type="date"
                                            id="birthdate"
                                            name="birthdate"
                                            value="{{ old('birthdate', optional($volunteer->birthdate)->format('Y-m-d')) }}"
                                            required
                                            class="form-control @error('birthdate') is-invalid @enderror" />
                                        @if ($errors->has('birthdate'))
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endif
                                    </div>
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
                                           class="form-control @error('password') is-invalid @enderror" />
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                    <small class="form-text text-muted">Dejalo en blanco si no deseas cambiarla</small>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Repite tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror" />
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                                           class="form-control @error('phone') is-invalid @enderror" />
                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="province_id" class="form-label">Provincia *</label>
                                    <select name="province_id" id="province_id" class="form-select @error('location_id') is-invalid @enderror">
                                        <option value="">Seleccione una provincia</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ $volunteer->location && $volunteer->location->province_id == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="location_id" class="form-label">Localidad *</label>
                                    <select name="location_id" id="location_id" class="form-select @error('location_id') is-invalid @enderror">
                                        @if ($volunteer->location)
                                            @foreach ($volunteer->location->province->locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ $volunteer->location_id == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('location_id')
                                        <div class="invalid-feedback d-block">El campo localidad es obligatorio.</div>
                                    @enderror
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
                                           class="form-control @error('linkedin') is-invalid @enderror" />
                                    @if ($errors->has('linkedin'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url"
                                           id="facebook"
                                           name="facebook"
                                           placeholder="https://facebook.com/usuario"
                                           value="{{ old('facebook', $volunteer->facebook) }}"
                                           class="form-control @error('facebook') is-invalid @enderror" />
                                    @if ($errors->has('facebook'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url"
                                           id="instagram"
                                           name="instagram"
                                           placeholder="https://instagram.com/usuario"
                                           value="{{ old('instagram', $volunteer->instagram) }}"
                                           class="form-control @error('instagram') is-invalid @enderror" />
                                    @if ($errors->has('instagram'))
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                                            class="form-select @error('educational_level') is-invalid @enderror">
                                        <option value="" disabled {{ old('educational_level', $volunteer->educational_level) == '' ? 'selected' : '' }}>
                                            Selecciona un nivel educativo
                                        </option>
                                        <option value="secundario" {{ old('educational_level', $volunteer->educational_level) === 'secundario' ? 'selected' : '' }}>Secundario</option>
                                        <option value="terciario" {{ old('educational_level', $volunteer->educational_level) === 'terciario' ? 'selected' : '' }}>Terciario</option>
                                        <option value="universitario" {{ old('educational_level', $volunteer->educational_level) === 'universitario' ? 'selected' : '' }}>Universitario</option>
                                        <option value="postgrado" {{ old('educational_level', $volunteer->educational_level) === 'postgrado' ? 'selected' : '' }}>Postgrado</option>
                                    </select>
                                    @if ($errors->has('educational_level'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="profession" class="form-label">Profesión</label>
                                    <input type="text"
                                           id="profession"
                                           name="profession"
                                           placeholder="Ingeniero, Profesor, Diseñador..."
                                           value="{{ old('profession', $volunteer->profession) }}"
                                           class="form-control @error('profession') is-invalid @enderror" />
                                    @if ($errors->has('profession'))
                                        <div class="invalid-feedback">{{ $message }}</div>
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

                                <div class="mb-3">
                                    <div class="pt-2">
                                        <img src="{{ asset('storage/' . ($volunteer->avatar ?? 'perfil-volunteer.svg')) }}"
                                            alt="Foto de perfil de {{ $volunteer->full_name }}"
                                            class="mb-3 rounded-circle img-fluid object-fit-contain avatar-md">
                                    </div>
                                    <label for="avatar" class="form-label">Foto de perfil</label>
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*"
                                           class="form-control @error('avatar') is-invalid @enderror" />
                                    @if ($errors->has('avatar'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                    <div class="form-text">La imagen debe tener un tamaño entre 100px y 300px de ancho y de alto y no debe pesar más de 500kb</div>

                                </div>

                                <div class="mb-3">
                                    <label for="biography" class="form-label">Biografía *</label>
                                    <textarea id="biography"
                                              name="biography"
                                              required
                                              placeholder="Contanos sobre vos..."
                                              rows="4"
                                              class="form-control @error('biography') is-invalid @enderror">{{ old('biography', $volunteer->biography) }}</textarea>
                                    @if ($errors->has('biography'))
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                    <div class="form-text">Tené en cuenta que esta es tu carta de presentación.</div>
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
