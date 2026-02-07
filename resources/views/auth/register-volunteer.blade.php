@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="title-h1 h3">Registrate como <span>voluntario</span></h1>
                        <p>Completá todos los datos requeridos para poder crear tu cuenta.</p>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Ir al login</a>
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
                  novalidate
                  action="{{ route('register-volunteer.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos personales</h2>
                                <p>Completá con tus datos.</p>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name"
                                               class="form-label">Nombre *</label>
                                        <input type="text"
                                               id="name"
                                               name="name"
                                               placeholder="Tu nombre"
                                               required
                                               autocomplete="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastname"
                                               class="form-label">Apellido *</label>
                                        <input type="text"
                                               id="lastname"
                                               name="lastname"
                                               placeholder="Apellido"
                                               required
                                               autocomplete="family-name"
                                               class="form-control @error('lastname') is-invalid @enderror"
                                               value="{{ old('lastname') }}" />
                                        @error('lastname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="dni"
                                               class="form-label">DNI *</label>
                                        <input type="text"
                                               id="dni"
                                               name="dni"
                                               placeholder="12345678"
                                               inputmode="numeric"
                                               required
                                               class="form-control @error('dni') is-invalid @enderror"
                                               value="{{ old('dni') }}" />
                                        @error('dni')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="birthdate"
                                               class="form-label">Fecha de nacimiento *</label>
                                        <input type="date"
                                               id="birthdate"
                                               name="birthdate"
                                               required
                                               class="form-control @error('birthdate') is-invalid @enderror"
                                               value="{{ old('birthdate') }}" />
                                        @error('birthdate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de acceso</h2>
                                <p>Completá con los datos que te serviran para acceder al sistema.</p>
                                <div class="mb-3">
                                    <label for="email"
                                           class="form-label">Email *</label>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           placeholder="ejemplo@correo.com"
                                           required
                                           autocomplete="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password"
                                           class="form-label">Contraseña *</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           placeholder="Ingresá tu contraseña"
                                           required
                                           autocomplete="new-password"
                                           class="form-control @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">La contraseña debe tener al menos 8 caracteres alfanuméricos.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                           class="form-label">Confirmar contraseña *</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Repetí tu contraseña"
                                           required
                                           autocomplete="new-password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror" />
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
                                <h2 class="card-title h3">Datos de contacto</h2>
                                <p>Completá con tus datos.</p>
                                <div class="mb-3">
                                    <label for="phone"
                                           class="form-label">Teléfono *</label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           placeholder="5491112345678"
                                           autocomplete="tel"
                                           required
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="province_id"
                                               class="form-label">Provincia *</label>
                                        <select name="province_id"
                                                id="province_id"
                                                class="form-select">
                                            <option value="">Seleccione una provincia</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="location_id"
                                               class="form-label">Localidad *</label>
                                        <select name="location_id"
                                                id="location_id"
                                                class="form-select">
                                            <option value="">Seleccione una localidad</option>
                                        </select>
                                        @error('location_id')
                                            <div class="invalid-feedback d-block">El campo localidad es obligatorio.</div>
                                        @enderror
                                    </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Redes sociales</h2>
                                <p>Completá al menos una de las redes sociales.</p>
                                <div class="mb-3">
                                    <label for="linkedin"
                                            class="form-label">LinkedIn</label>
                                    <input type="url"
                                            id="linkedin"
                                            name="linkedin"
                                            placeholder="https://linkedin.com/in/usuario"
                                            class="form-control @error('linkedin') is-invalid @enderror"
                                            value="{{ old('linkedin') }}" />
                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="facebook"
                                            class="form-label">Facebook</label>
                                    <input type="url"
                                            id="facebook"
                                            name="facebook"
                                            placeholder="https://facebook.com/usuario"
                                            class="form-control @error('facebook') is-invalid @enderror"
                                            value="{{ old('facebook') }}" />
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="instagram"
                                            class="form-label">Instagram</label>
                                    <input type="url"
                                            id="instagram"
                                            name="instagram"
                                            placeholder="https://instagram.com/usuario"
                                            class="form-control @error('instagram') is-invalid @enderror"
                                            value="{{ old('instagram') }}" />
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($errors->has('linkedin') || $errors->has('facebook') || $errors->has('instagram'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('linkedin') ?? ($errors->first('facebook') ?? $errors->first('instagram')) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos profesionales</h2>
                                <p>Completá con tus datos.</p>
                                <div class="mb-3">
                                    <label for="educational_level"
                                            class="form-label">Nivel Educativo *</label>
                                    <select name="educational_level"
                                            id="educational_level"
                                            required
                                            class="form-select @error('educational_level') is-invalid @enderror">
                                        <option value=""
                                                disabled
                                                {{ old('educational_level') ? '' : 'selected' }}>Selecciona un nivel
                                            educativo</option>
                                        <option value="Secundario"
                                                {{ old('educational_level') == 'Secundario' ? 'selected' : '' }}>Secundario
                                        </option>
                                        <option value="Postgrado"
                                                {{ old('educational_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado
                                        </option>
                                        <option value="Terciario"
                                                {{ old('educational_level') == 'Terciario' ? 'selected' : '' }}>Terciario
                                        </option>
                                        <option value="Universitario"
                                                {{ old('educational_level') == 'Universitario' ? 'selected' : '' }}>
                                            Universitario</option>
                                    </select>
                                    @error('educational_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="profession"
                                            class="form-label">Profesión</label>
                                    <input type="text"
                                            id="profession"
                                            name="profession"
                                            placeholder="Ingeniero"
                                            class="form-control @error('profession') is-invalid @enderror"
                                            value="{{ old('profession') }}" />
                                    @error('profession')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Info extra</h2>
                                <div class="mb-3">
                                    <label for="avatar"
                                            class="form-label">Foto de perfil</label>
                                    <input type="file"
                                            id="avatar"
                                            name="avatar"
                                            accept="image/*"
                                            class="form-control @error('avatar') is-invalid @enderror" />
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">La imagen debe tener un tamaño entre 100px y 300px de ancho y de
                                        alto y no debe pesar más de 500kb</div>
                                </div>

                                <div class="mb-3">
                                    <label for="biography"
                                            class="form-label">Biografía *</label>
                                    <textarea id="biography"
                                                name="biography"
                                                required
                                                placeholder="Contanos sobre vos..."
                                                rows="4"
                                                class="form-control @error('biography') is-invalid @enderror">{{ old('biography') }}</textarea>
                                    @error('biography')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Tené en cuenta que esta es tu carta de presentación.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-outline-primary btn-lg px-5">Volver</a>
                    <button type="submit"
                            class="btn btn-primary btn-lg px-5">Enviar</button>
                </div>


            </form>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province_id');
            const locationSelect = document.getElementById('location_id');

            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;

                // Limpiar localidades
                locationSelect.innerHTML = '<option value="">Seleccione una localidad</option>';

                if (!provinceId) return;

                fetch(`/locations/${provinceId}`)
                    .then(response => response.json())
                    .then(locations => {
                        locations.forEach(location => {
                            const option = document.createElement('option');
                            option.value = location.id;
                            option.textContent = location.name;
                            locationSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar localidades:', error));
            });
        });
    </script>
@endpush
