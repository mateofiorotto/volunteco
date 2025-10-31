@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">

            <div class="row mb-5">
                <div class="col-md-7">
                    <h1 class="title-h1 h3">Registrate como <span>Voluntario</span></h1>
                    <p class="mb-3">Completá todos los datos requeridos para poder crear tu cuenta.</p>
                </div>
            </div>

            <form method="POST"
                  action="{{ route('volunteers.update-my-profile') }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos Personales</h2>
                                <p class="mb-3">Completa con tus datos.</p>

                                <div class="mb-3">
                                    <label for="full_name"
                                           class="form-label">Nombre Completo *</label>
                                    <input type="text"
                                           id="full_name"
                                           name="full_name"
                                           placeholder="Tu nombre completo"
                                           required
                                           autocomplete="name"
                                           value="{{ old('full_name', $volunteer->full_name) }}"
                                           class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label for="birthdate"
                                           class="form-label">Fecha de nacimiento *</label>
                                    <input type="date"
                                           id="birthdate"
                                           name="birthdate"
                                           value="{{ old('birthdate', $volunteer->birthdate) }}"
                                           required
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Acceso</h2>
                                <p class="mb-3">Completa con los datos que te serviran para acceder al sistema.</p>

                                <div class="mb-3">
                                    <label for="password"
                                           class="form-label">Contraseña</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           placeholder="Ingresa tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                           class="form-label">Confirmar contraseña</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Repite tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos Profesionales</h2>
                                <p class="mb-3">Completa con tus datos.</p>
                                <div class="mb-3">

                                    <label for="educational_level"
                                           class="form-label">Nivel Educativo *</label>
                                    <select name="educational_level"
                                            id="educational_level"
                                            required
                                            class="form-control">
                                        <option value=""
                                                disabled
                                                {{ old('educational_level', $volunteer->educational_level) == '' ? 'selected' : '' }}>
                                            Selecciona un nivel educativo</option>
                                        <option value="secundario"
                                                {{ old('educational_level', $volunteer->educational_level) === 'secundario' ? 'selected' : '' }}>
                                            Secundario</option>
                                        <option value="terciario"
                                                {{ old('educational_level', $volunteer->educational_level) === 'terciario' ? 'selected' : '' }}>
                                            Terciario</option>
                                        <option value="postgrado"
                                                {{ old('educational_level', $volunteer->educational_level) === 'postgrado' ? 'selected' : '' }}>
                                            Postgrado</option>
                                        <option value="universitario"
                                                {{ old('educational_level', $volunteer->educational_level) === 'universitario' ? 'selected' : '' }}>
                                            Universitario</option>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <label for="profession"
                                           class="form-label">Profesión</label>
                                    <input type="text"
                                           id="profession"
                                           value="{{ old('profession', $volunteer->profession) }}"
                                           name="profession"
                                           placeholder="Ej: Ingeniero"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Contacto</h2>
                                <p class="mb-3">Completa con tus datos.</p>
                                <div class="mb-3">
                                    <label for="phone"
                                           class="form-label">Teléfono *</label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', $volunteer->phone) }}"
                                           placeholder="5491112345678"
                                           autocomplete="tel"
                                           required
                                           class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label for="location"
                                           class="form-label">Residencia *</label>
                                    <input type="text"
                                           id="location"
                                           name="location"
                                           required
                                           value="{{ old('location', $volunteer->location) }}"
                                           placeholder="Ciudad o provincia"
                                           autocomplete="address-level2"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Redes Sociales</h2>
                                <div class="mb-3">
                                    <label for="linkedin"
                                           class="form-label">LinkedIn</label>
                                    <input type="url"
                                           id="linkedin"
                                           value="{{ old('linkedin', $volunteer->linkedin) }}"
                                           name="linkedin"
                                           placeholder="https://linkedin.com/in/usuario"
                                           class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="facebook"
                                           class="form-label">Facebook</label>
                                    <input type="url"
                                           id="facebook"
                                           value="{{ old('facebook', $volunteer->facebook) }}"
                                           name="facebook"
                                           placeholder="https://facebook.com/usuario"
                                           class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="instagram"
                                           class="form-label">Instagram</label>
                                    <input type="url"
                                           id="instagram"
                                           value="{{ old('instagram', $volunteer->instagram) }}"
                                           name="instagram"
                                           placeholder="https://instagram.com/usuario"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Info Extra</h2>
                                <p class="mb-3">Completa con tus datos.</p>
                                <div class="mb-3">

                                    <label for="avatar"
                                           class="form-label">Foto de perfil</label>
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*"
                                           class="form-control" />
                                    <p class="pt-3 pb-3">Foto de perfil actual:</p>
                                    <img src="{{ asset('storage/' . $volunteer->avatar) }}"
                                         alt="Foto de perfil de {{ $volunteer->full_name }}"
                                         class="mt-3 mb-3 rounded-circle img-fluid object-fit-cover avatar-md">
                                </div>
                                <div class="mb-3">
                                    <label for="biography"
                                           class="form-label">Biografía *</label>
                                    <textarea id="biography"
                                              name="biography"
                                              required
                                              placeholder="Contanos sobre vos..."
                                              rows="4"
                                              class="form-control">{{ old('biography', $volunteer->biography) }} </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-outline-primary btn-lg px-5">Volver</a>
                    <button type="submit"
                            class="btn btn-primary btn-lg px-5">Actualizar</button>
                </div>

            </form>

        </div>
    </section>
@endsection
