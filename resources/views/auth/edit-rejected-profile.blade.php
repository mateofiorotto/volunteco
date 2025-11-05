@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h1 class="title-h1 h3">Actualiza <span>tu perfil</span></h1>
                    <p>Estimado <span class="fw-semibold fs-5">{{ old('email', $host->email ?? '') }}:</span><br />Completá
                        todos los datos que te pedimos por correo.<br />Luego de enviada tu solicitud, nuestros
                        administradores revisarán tu
                        perfil y serás notificado cuando esté aprobado para que puedas empezar a publicar tus proyectos.</p>
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
                  action="{{ route('edit-rejected-profile.update', ['token' => $token, 'email' => $email]) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Organización</h2>
                                <p>Completa con los datos de la organización.</p>
                                <div class="mb-3">
                                    <label for="nombre"
                                           class="form-label">Nombre *</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           placeholder="Nombre de la organización"
                                           required
                                           autocomplete="name"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           value="{{ old('name', $host->host->name ?? '') }}" />

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="cuit"
                                           class="form-label">CUIT *</label>
                                    <input type="text"
                                           id="cuit"
                                           name="cuit"
                                           placeholder="Ej: 20123456789"
                                           inputmode="numeric"
                                           required
                                           class="form-control {{ $errors->has('cuit') ? 'is-invalid' : '' }}"
                                           value="{{ old('cuit', $host->host->cuit ?? '') }}" />
                                    @if ($errors->has('cuit'))
                                        <p class="text-danger">{{ $errors->first('cuit') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="person_full_name"
                                           class="form-label">Nombre de persona de contacto *</label>
                                    <input type="text"
                                           id="person_full_name"
                                           name="person_full_name"
                                           placeholder="Nombre de persona física para contacto"
                                           autocomplete="name"
                                           class="form-control {{ $errors->has('person_full_name') ? 'is-invalid' : '' }}"
                                           value="{{ old('person_full_name', $host->host->person_full_name ?? '') }}" />
                                    @if ($errors->has('person_full_name'))
                                        <p class="text-danger">{{ $errors->first('person_full_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone"
                                           class="form-label">Teléfono *</label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           placeholder="5491112345678"
                                           autocomplete="tel"
                                           class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                           value="{{ old('phone', $host->host->phone ?? '') }}" />
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="location"
                                           class="form-label">Ubicación</label>
                                    <input type="text"
                                           id="location"
                                           name="location"
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

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Redes Sociales</h2>
                                <p>Completá al menos una de las redes sociales.</p>
                                <div class="mb-3">
                                    <label for="linkedin"
                                           class="form-label">LinkedIn *</label>
                                    <input type="url"
                                           id="linkedin"
                                           name="linkedin"
                                           placeholder="https://linkedin.com/in/usuario"
                                           class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                           value="{{ old('linkedin', $host->host->linkedin ?? '') }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="facebook"
                                           class="form-label">Facebook *</label>
                                    <input type="url"
                                           id="facebook"
                                           name="facebook"
                                           placeholder="https://facebook.com/usuario"
                                           class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                           value="{{ old('facebook', $host->host->facebook ?? '') }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="instagram"
                                           class="form-label">Instagram *</label>
                                    <input type="url"
                                           id="instagram"
                                           name="instagram"
                                           placeholder="https://instagram.com/usuario"
                                           class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                           value="{{ old('instagram', $host->host->instagram ?? '') }}" />
                                </div>

                                @if ($errors->has('social_media'))
                                    <p class="text-danger">{{ $errors->first('social_media') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Info Extra</h2>
                                <div class="mb-3 d-flex flex-column">
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $host->host->avatar) }}"
                                             width="150"
                                             height="150"
                                             alt="Foto de perfil"
                                             class="object-fit-contain" />
                                    </div>
                                    <label for="avatar"
                                           class="form-label">Logo</label>
                                    <p>100x100px - 300x300px. 512KB</p>
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*"
                                           class="form-control" />
                                    @if ($errors->has('avatar'))
                                        <p class="text-danger">{{ $errors->first('avatar') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="description"
                                           class="form-label">Descripción *</label>
                                    <textarea id="description"
                                              name="description"
                                              placeholder="Descripción acerca de la organización/anfitrión"
                                              rows="6"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $host->host->description ?? '') }}</textarea>
                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <button type="submit"
                            class="btn btn-primary btn-lg px-5">Enviar</button>
                </div>

            </form>

        </div>
    </section>
@endsection
