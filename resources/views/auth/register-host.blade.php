@extends('layouts.app')
<!--Register host form-->
@section('content')
    <section>
        <div class="container py-5">

            <div class="row mb-5">
                <div class="col-md-7">
                    <h1 class="title-h1 h3">Registrate como <span>Anfitrión</span></h1>
                    <p>Completá todos los datos requeridos.<br/>Luego de enviada tu solicitud, nuestros operadores revisarán tu perfil y serás notificado cuando esté aprobado para que puedas empezar a publicar tus proyectos.</p>
                </div>
            </div>

            {{-- Alerta de errores general --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" novalidate action="{{ route('register-host.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Organización</h2>
                                <p>Completa con los datos de la organización.</p>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre *</label>
                                    <input type="text"
                                        id="name"
                                        name="name"
                                        placeholder="Nombre de la organización"
                                        required
                                        autocomplete="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ old('name') }}"
                                    />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cuit" class="form-label">CUIT *</label>
                                    <input type="text"
                                        id="cuit"
                                        name="cuit"
                                        placeholder="Ej: 20123456789"
                                        inputmode="numeric"
                                        required
                                        class="form-control {{ $errors->has('cuit') ? 'is-invalid' : '' }}"
                                        value="{{ old('cuit') }}"
                                    />
                                    @error('cuit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="person_full_name" class="form-label">Nombre de persona de contacto *</label>
                                    <input type="text"
                                        id="person_full_name"
                                        name="person_full_name"
                                        required
                                        placeholder="Nombre de persona física para contacto"
                                        autocomplete="name"
                                        class="form-control {{ $errors->has('person_full_name') ? 'is-invalid' : '' }}"
                                        value="{{ old('person_full_name') }}"
                                    />
                                    @error('person_full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Teléfono *</label>
                                    <input type="tel"
                                        id="phone"
                                        name="phone"
                                        placeholder="5491112345678"
                                        autocomplete="tel"
                                        required
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        value="{{ old('phone') }}"
                                    />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Ubicación</label>
                                    <input type="text"
                                        id="location"
                                        name="location"
                                        placeholder="Ciudad o provincia"
                                        autocomplete="address-level2"
                                        class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                        value="{{ old('location') }}"
                                    />
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de Acceso</h2>
                                <p>Completá con los datos que te serviran para acceder al sistema.</p>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email"
                                        id="email"
                                        name="email"
                                        placeholder="ejemplo@correo.com"
                                        required
                                        autocomplete="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ old('email') }}"
                                    />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña *</label>
                                    <input type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Ingresa tu contraseña"
                                        required
                                        autocomplete="off"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña *</label>
                                    <input type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Repite tu contraseña"
                                        required
                                        autocomplete="off"
                                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                    />
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input type="url"
                                        id="linkedin"
                                        name="linkedin"
                                        placeholder="https://linkedin.com/in/usuario"
                                        class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                        value="{{ old('linkedin') }}"/>
                                </div>

                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url"
                                        id="facebook"
                                        name="facebook"
                                        placeholder="https://facebook.com/usuario"
                                        class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                        value="{{ old('facebook') }}"/>
                                </div>

                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url"
                                        id="instagram"
                                        name="instagram"
                                        placeholder="https://instagram.com/usuario"
                                        class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}"
                                        value="{{ old('instagram') }}"/>
                                </div>

                                @if ($errors->any())
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                        <strong>Ups! Hubo algunos errores:</strong>
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @error('social_media')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Info Extra</h2>
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Logo</label>
                                    <input type="file"
                                        id="avatar"
                                        name="avatar"
                                        accept="image/*"
                                        class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}"
                                    />
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">La imagen debe tener un tamaño entre 100px y 300px de ancho y de alto y no debe pesar más de 500kb</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción *</label>
                                    <textarea id="description"
                                            name="description"
                                            placeholder="Descripción acerca de la organización/anfitrión"
                                            rows="6"
                                            required
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">
                                            {{ old('description') }}
                                    </textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
