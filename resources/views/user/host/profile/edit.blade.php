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

            <form method="POST"
                  action="{{ route('hosts.update-my-profile') }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row">

                    {{-- DATOS DEL ANFITRIÓN --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos del Anfitrión</h2>
                                <p class="mb-3">Completa con los datos de tu organización o nombre.</p>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre del Anfitrión *</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           placeholder="Nombre de la organización o anfitrión"
                                           required
                                           autocomplete="organization"
                                           value="{{ old('name', $host->name) }}"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                    <small class="form-text text-muted">Nombre de la ONG o del anfitrión individual</small>
                                </div>

                                <div class="mb-3">
                                    <label for="person_full_name" class="form-label">Persona de Contacto *</label>
                                    <input type="text"
                                           id="person_full_name"
                                           name="person_full_name"
                                           placeholder="Nombre y apellido de la persona de contacto"
                                           required
                                           autocomplete="name"
                                           value="{{ old('person_full_name', $host->person_full_name) }}"
                                           class="form-control {{ $errors->has('person_full_name') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('person_full_name'))
                                        <p class="text-danger">{{ $errors->first('person_full_name') }}</p>
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
                                           value="{{ old('phone', $host->phone) }}"
                                           placeholder="5491112345678"
                                           autocomplete="tel"
                                           required
                                           class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Ubicación</label>
                                    <input type="text"
                                           id="location"
                                           name="location"
                                           value="{{ old('location', $host->location) }}"
                                           placeholder="Ciudad o provincia"
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
                                           placeholder="https://linkedin.com/company/organizacion"
                                           value="{{ old('linkedin', $host->linkedin) }}"
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
                                           placeholder="https://facebook.com/organizacion"
                                           value="{{ old('facebook', $host->facebook) }}"
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
                                           placeholder="https://instagram.com/organizacion"
                                           value="{{ old('instagram', $host->instagram) }}"
                                           class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('instagram'))
                                        <p class="text-danger">{{ $errors->first('instagram') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMACIÓN ADICIONAL --}}
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Información Adicional</h2>
                                <p class="mb-3">Completa con los datos de tu organización.</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Foto de perfil</label>
                                            <input type="file"
                                                   id="avatar"
                                                   name="avatar"
                                                   accept=".jpg, .jpeg, .png, .gif, .webp"
                                                   class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('avatar'))
                                                <p class="text-danger">{{ $errors->first('avatar') }}</p>
                                            @endif
                                            <p class="pt-3 pb-3">Foto de perfil actual:</p>
                                            <img src="{{ asset('storage/' . $host->avatar) }}"
                                                 alt="Foto de perfil de {{ $host->name }}"
                                                 class="mt-3 mb-3 rounded-circle img-fluid object-fit-cover avatar-md">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Descripción *</label>
                                            <textarea id="description"
                                                      name="description"
                                                      required
                                                      placeholder="Contanos sobre tu organización..."
                                                      rows="8"
                                                      class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $host->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                            <small class="form-text text-muted">Describe la misión y objetivos de tu organización</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg px-5">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg px-5">Actualizar</button>
                </div>

            </form>

        </div>
    </section>
@endsection
