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
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text"
                            id="full_name"
                            name="full_name"
                            placeholder="Tu nombre completo"
                            required
                            autocomplete="name"
                            class="form-control"/>
                        </div>

                        <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text"
                            id="dni"
                            name="dni"
                            placeholder="Ej: 12345678"
                            inputmode="numeric"
                            required
                            class="form-control"/>
                        </div>
                        <div class="mb-3">
                        <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                        <input type="date"
                            id="birthdate"
                            name="birthdate"
                            required
                            class="form-control"/>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            id="email"
                            name="email"
                            placeholder="ejemplo@correo.com"
                            required
                            autocomplete="email"
                            class="form-control"/>
                        </div>

                        <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password"
                            id="password"
                            name="password"
                            placeholder="Ingresa tu contraseña"
                            required
                            autocomplete="new-password"
                            class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repite tu contraseña"
                                required
                                autocomplete="new-password"
                                class="form-control"/>
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

                        <label for="educational_level" class="form-label">Nivel educativo</label>
                        <select name="educational_level"
                                id="educational_level"
                                required
                                class="form-control">
                            <option value=""
                                    disabled
                                    selected>Selecciona un nivel educativo</option>
                            <option value="Secundario">Secundario</option>
                            <option value="Postgrado">Postgrado</option>
                            <option value="Terciario">Terciario</option>
                            <option value="Universitario">Universitario</option>
                        </select>
                        </div>
                        <div class="mb-3">

                        <label for="profession" class="form-label">Profesión</label>
                        <input type="text"
                            id="profession"
                            name="profession"
                            placeholder="Ej: Ingeniero"
                            class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos de contacto</h2>
                        <p>Completa con tus datos.</p>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel"
                                id="phone"
                                name="phone"
                                placeholder="5491112345678"
                                autocomplete="tel"
                                class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Residencia</label>
                            <input type="text"
                                id="location"
                                name="location"
                                placeholder="Ciudad o provincia"
                                autocomplete="address-level2"
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
                                class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url"
                                id="facebook"
                                name="facebook"
                                placeholder="https://facebook.com/usuario"
                                class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url"
                                id="instagram"
                                name="instagram"
                                placeholder="https://instagram.com/usuario"
                                class="form-control"/>
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
                        <input type="file"
                            id="avatar"
                            name="avatar"
                            accept="image/*"
                            class="form-control"/>
                        </div>
                        <div class="mb-3">

                        <label for="description" class="form-label">Biografía</label>
                        <textarea id="biography"
                                name="biography"
                                placeholder="Contanos sobre vos..."
                                rows="4" class="form-control"></textarea>
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
