@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">

            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <h1 class="title-h1 h3">Editar <span>mi perfil</span></h1>
                    <p class="mb-3">Completá todos los datos requeridos para actualizar tu perfil.</p>
                </div>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
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
                  action="{{ route('host.my-profile.update', $host->user_id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- DATOS DEL ANFITRIÓN --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos del anfitrión</h2>
                                <p class="mb-3">Completa con los datos de tu organización o nombre.</p>

                                <div class="mb-3">
                                    <label for="name"
                                           class="form-label">Nombre del anfitrión *</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           placeholder="Nombre de la organización o anfitrión"
                                           required
                                           autocomplete="organization"
                                           value="{{ old('name', $host->name) }}"
                                           class="form-control @error('name') is-invalid @enderror" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Nombre de la ONG o del anfitrión individual</small>
                                </div>

                                <div class="mb-3">
                                    <label for="cuit"
                                           class="form-label">CUIT *</label>
                                    <input type="text"
                                           id="cuit"
                                           name="cuit"
                                           placeholder="20123456789"
                                           inputmode="numeric"
                                           required
                                           class="form-control @error('cuit') is-invalid @enderror"
                                           value="{{ old('cuit', $host->cuit) }}" />
                                    @error('cuit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="person_full_name"
                                           class="form-label">Persona de contacto *</label>
                                    <input type="text"
                                           id="person_full_name"
                                           name="person_full_name"
                                           placeholder="Nombre y apellido de la persona de contacto"
                                           required
                                           autocomplete="name"
                                           value="{{ old('person_full_name', $host->person_full_name) }}"
                                           class="form-control @error('person_full_name') is-invalid @enderror" />
                                    @error('person_full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DATOS DE ACCESO --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de acceso</h2>
                                <p class="mb-3">Completa con los datos que te servirán para acceder al sistema.</p>

                                <div class="mb-3">
                                    <label for="password"
                                           class="form-label">Contraseña</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           placeholder="Ingresá tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Dejálo en blanco si no deseas cambiarla</small>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                           class="form-label">Confirmar contraseña</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Repetí tu contraseña"
                                           autocomplete="new-password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror" />
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DATOS DE CONTACTO --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Datos de contacto</h2>
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
                                           class="form-control @error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="province_id"
                                           class="form-label">Provincia *</label>
                                    <select name="province_id"
                                            id="province_id"
                                            class="form-select">
                                        <option value="">Seleccione una provincia</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                    {{ $host->location && $host->location->province_id == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
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
                                        @if ($host->location && $host->location->province)
                                            @foreach ($host->location->province->locations as $location)
                                                <option value="{{ $location->id }}"
                                                        {{ $host->location_id == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- REDES SOCIALES --}}
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Redes sociales</h2>

                                <div class="mb-3">
                                    <label for="linkedin"
                                           class="form-label">LinkedIn</label>
                                    <input type="url"
                                           id="linkedin"
                                           name="linkedin"
                                           placeholder="https://linkedin.com/company/organizacion"
                                           value="{{ old('linkedin', $host->linkedin) }}"
                                           class="form-control @error('linkedin') is-invalid @enderror" />
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
                                           placeholder="https://facebook.com/organizacion"
                                           value="{{ old('facebook', $host->facebook) }}"
                                           class="form-control @error('facebook') is-invalid @enderror" />
                                    @error('facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="instagram"
                                            class="form-label">Instagram</label>
                                    <input type="url"
                                            id="instagram"
                                            name="instagram"
                                            placeholder="https://instagram.com/organizacion"
                                            value="{{ old('instagram', $host->instagram) }}"
                                            class="form-control @error('instagram') is-invalid @enderror" />
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMACIÓN ADICIONAL --}}
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h2 class="card-title h3">Información adicional</h2>
                                <p class="mb-3">Completa con los datos de tu organización.</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="avatar-md mb-3">
                                            <img src="{{ asset('storage/' . ($host->avatar ?? 'perfil-host.svg')) }}"
                                                    alt="Foto de perfil de {{ $host->name }}"
                                                    class="rounded-circle img-fluid object-fit-contain avatar-md"
                                                    width="100"
                                                    height="100">
                                        </div>
                                        <div class="mb-3">
                                            <label for="avatar"
                                                    class="form-label">Foto de perfil</label>
                                            <input type="file"
                                                    id="avatar"
                                                    name="avatar"
                                                    accept=".jpg, .jpeg, .png, .gif, .webp"
                                                    class="form-control @error('avatar') is-invalid @enderror" />
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">La imagen debe tener un tamaño entre 100px y 300px de
                                                ancho y de alto y no debe pesar más de 500kb</div>
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
                                                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $host->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                            @enderror
                                            <div class="form-text">Describe la misión y objetivos de tu organización</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-outline-primary btn-lg px-5">Cancelar</a>
                    <button type="submit"
                            class="btn btn-primary btn-lg px-5">Actualizar</button>
                </div>

            </form>

        </div>
    </section>
@endsection

@section('scripts')
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
@endsection
