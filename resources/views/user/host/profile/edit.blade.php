@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">

            <div class="row mb-5">
                <div class="col-md-7">
                    <h1 class="title-h1 h3">Editar perfil de <span>Anfitrión</span></h1>
                    <p class="mb-3">Completá todos los datos requeridos para actualizar tu perfil.</p>
                </div>
            </div>

            <form method="POST"
                  action="{{ route('hosts.update-my-profile') }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos del Anfitrión</h2>
                                <p class="mb-3">Completa con los datos de tu organización o nombre.</p>

                                <div class="mb-3">
                                    <label for="name"
                                           class="form-label">Nombre del Anfitrión *</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           placeholder="Nombre de la organización o anfitrión"
                                           required
                                           autocomplete="organization"
                                           value="{{ old('name', $host->name) }}"
                                           class="form-control" />
                                    <small class="form-text text-muted">Nombre de la ONG o del anfitrión individual</small>
                                </div>

                                <div class="mb-3">
                                    <label for="person_full_name"
                                           class="form-label">Persona de Contacto *</label>
                                    <input type="text"
                                           id="person_full_name"
                                           name="person_full_name"
                                           placeholder="Nombre y apellido de la persona de contacto"
                                           required
                                           autocomplete="name"
                                           value="{{ old('person_full_name', $host->person_full_name) }}"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Acceso</h2>
                                <p class="mb-3">Completa con los datos que te servirán para acceder al sistema.</p>

                                <div class="mb-3">
                                    <label for="password"
                                           class="form-label">Contraseña</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           placeholder="Ingresa tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control" />
                                    <small class="form-text text-muted">Déjalo en blanco si no deseas cambiarla</small>
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
                                <h2 class="card-title h3">Datos de Contacto</h2>
                                <p class="mb-3">Completa con tus datos.</p>
                                
                                <div class="mb-3">
                                    <label for="phone"
                                           class="form-label">Teléfono *</label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', $host->phone) }}"
                                           placeholder="5491112345678"
                                           autocomplete="tel"
                                           required
                                           class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label for="location"
                                           class="form-label">Ubicación *</label>
                                    <input type="text"
                                           id="location"
                                           name="location"
                                           required
                                           value="{{ old('location', $host->location) }}"
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
                                           value="{{ old('linkedin', $host->linkedin) }}"
                                           name="linkedin"
                                           placeholder="https://linkedin.com/company/organizacion"
                                           class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="facebook"
                                           class="form-label">Facebook</label>
                                    <input type="url"
                                           id="facebook"
                                           value="{{ old('facebook', $host->facebook) }}"
                                           name="facebook"
                                           placeholder="https://facebook.com/organizacion"
                                           class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="instagram"
                                           class="form-label">Instagram</label>
                                    <input type="url"
                                           id="instagram"
                                           value="{{ old('instagram', $host->instagram) }}"
                                           name="instagram"
                                           placeholder="https://instagram.com/organizacion"
                                           class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Información Adicional</h2>
                                <p class="mb-3">Completa con los datos de tu organización.</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="avatar"
                                                   class="form-label">Foto de perfil</label>
                                            <input type="file"
                                                   id="avatar"
                                                   name="avatar"
                                                   accept="image/*"
                                                   class="form-control" />
                                            <p class="pt-3 pb-3">Foto de perfil actual:</p>
                                            <img src="{{ asset('storage/' . $host->avatar) }}"
                                                 alt="Foto de perfil de {{ $host->name }}"
                                                 class="mt-3 mb-3 rounded-circle img-fluid object-fit-cover avatar-md">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description"
                                                   class="form-label">Descripción *</label>
                                            <textarea id="description"
                                                      name="description"
                                                      required
                                                      placeholder="Contanos sobre tu organización..."
                                                      rows="8"
                                                      class="form-control">{{ old('description', $host->description) }}</textarea>
                                            <small class="form-text text-muted">Describe la misión y objetivos de tu organización</small>
                                        </div>
                                    </div>
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