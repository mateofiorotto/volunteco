@extends('layouts.app')

@section('content')
<section>
    <div class="container py-5">

        <div class="row mb-5">
            <div class="col-md-7">
                <h1 class="title-h1 h3">Modifica tu <span>Perfil</span></h1>
                <p>Actualiza los datos que te solicitamos por correo.</p>
            </div>
        </div>

        <form method="POST"
              action="{{ route('edit-rejected-profile.update', ['token' => $token, 'email' => $email]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h2 class="card-title h3">Datos de la Organización</h2>
                            <p>Completa con los datos de tu organización.</p>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Organización *</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       placeholder="Nombre de organización"
                                       required
                                       autocomplete="name"
                                       value="{{ old('name', $host->host->name ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="person_full_name" class="form-label">Nombre de Persona a Contactar *</label>
                                <input type="text"
                                       id="person_full_name"
                                       name="person_full_name"
                                       placeholder="Nombre de persona física para contacto"
                                       required
                                       autocomplete="name"
                                       value="{{ old('person_full_name', $host->host->person_full_name ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="cuit" class="form-label">CUIT *</label>
                                <input type="text"
                                       id="cuit"
                                       name="cuit"
                                       placeholder="Ej: 20123456789"
                                       inputmode="numeric"
                                       required
                                       value="{{ old('cuit', $host->host->cuit ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción *</label>
                                <textarea id="description"
                                          name="description"
                                          required
                                          placeholder="Descripción acerca de la organización/anfitrión"
                                          rows="4"
                                          class="form-control">{{ old('description', $host->host->description ?? '') }}</textarea>
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
                                       value="{{ old('phone', $host->host->phone ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicación *</label>
                                <input type="text"
                                       id="location"
                                       name="location"
                                       required
                                       placeholder="Ciudad o provincia"
                                       autocomplete="address-level2"
                                       value="{{ old('location', $host->host->location ?? '') }}"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h2 class="card-title h3">Redes Sociales</h2>
                            <p>Completa al menos uno de los campos.</p>

                            <div class="mb-3">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url"
                                       id="linkedin"
                                       name="linkedin"
                                       placeholder="https://linkedin.com/in/usuario"
                                       value="{{ old('linkedin', $host->host->linkedin ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="url"
                                       id="facebook"
                                       name="facebook"
                                       placeholder="https://facebook.com/usuario"
                                       value="{{ old('facebook', $host->host->facebook ?? '') }}"
                                       class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="url"
                                       id="instagram"
                                       name="instagram"
                                       placeholder="https://instagram.com/usuario"
                                       value="{{ old('instagram', $host->host->instagram ?? '') }}"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h2 class="card-title h3">Foto de Perfil</h2>
                            <p>Imagen actual o sube una nueva.</p>

                            @if(!empty($host->host->avatar))
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $host->host->avatar) }}"
                                     alt="Foto de perfil"
                                     class="img-thumbnail"
                                     style="max-width: 200px;"/>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Actualizar Foto de Perfil</label>
                                <input type="file"
                                       id="avatar"
                                       name="avatar"
                                       accept="image/*"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg px-5">Volver</a>
                <button type="submit" class="btn btn-primary btn-lg px-5">Guardar Cambios</button>
            </div>

        </form>

    </div>
</section>
@endsection