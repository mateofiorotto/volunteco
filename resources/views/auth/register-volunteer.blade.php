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

        {{-- Alerta de errores general --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <form method="POST" novalidate action="{{ route('register-volunteer.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Datos Personales</h2>
                        <p>Completa con tus datos.</p>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo *</label>
                            <input type="text"
                                id="full_name"
                                name="full_name"
                                placeholder="Tu nombre completo"
                                required
                                autocomplete="name"
                                class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name') }}"/>
                                @if ($errors->has('full_name'))
                                    <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI *</label>
                            <input type="text"
                                id="dni"
                                name="dni"
                                placeholder="Ej: 12345678"
                                inputmode="numeric"
                                required
                                class="form-control @error('dni') is-invalid @enderror"
                                value="{{ old('dni') }}"/>
                                @if ($errors->has('dni'))
                                    <div class="invalid-feedback">{{ $errors->first('dni') }}</div>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Fecha de nacimiento *</label>
                            <input type="date"
                                id="birthdate"
                                name="birthdate"
                                required
                                class="form-control @error('birthdate') is-invalid @enderror"
                                value="{{ old('birthdate') }}"/>
                                @if ($errors->has('birthdate'))
                                    <div class="invalid-feedback">{{ $errors->first('birthdate') }}</div>
                                @endif
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
                            <label for="email" class="form-label">Email *</label>
                            <input type="email"
                                id="email"
                                name="email"
                                placeholder="ejemplo@correo.com"
                                required
                                autocomplete="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"/>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña *</label>
                            <input type="password"
                                id="password"
                                name="password"
                                placeholder="Ingresa tu contraseña"
                                required
                                autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror"/>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña *</label>
                            <input type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repite tu contraseña"
                                required
                                autocomplete="new-password"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"/>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif
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
                            <label for="educational_level" class="form-label">Nivel Educativo *</label>
                            <select name="educational_level" id="educational_level" required class="form-select @error('educational_level') is-invalid @enderror">
                                <option value="" disabled {{ old('educational_level') ? '' : 'selected' }}>Selecciona un nivel educativo</option>
                                <option value="Secundario" {{ old('educational_level') == 'Secundario' ? 'selected' : '' }}>Secundario</option>
                                <option value="Postgrado" {{ old('educational_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado</option>
                                <option value="Terciario" {{ old('educational_level') == 'Terciario' ? 'selected' : '' }}>Terciario</option>
                                <option value="Universitario" {{ old('educational_level') == 'Universitario' ? 'selected' : '' }}>Universitario</option>
                            </select>
                            @if ($errors->has('educational_level'))
                                <div class="invalid-feedback">{{ $errors->first('educational_level') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="profession" class="form-label">Profesión</label>
                            <input type="text"
                                id="profession"
                                name="profession"
                                placeholder="Ej: Ingeniero"
                                class="form-control @error('profession') is-invalid @enderror"
                                value="{{ old('profession') }}"/>
                                @if ($errors->has('profession'))
                                    <div class="invalid-feedback">{{ $errors->first('profession') }}</div>
                                @endif
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
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"/>
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="province_id" class="form-label">Provincia</label>
                            <select name="province_id" id="province_id" class="form-select">
                                <option value="">Seleccione una provincia</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="location_id" class="form-label">Localidad</label>
                            <select name="location_id" id="location_id" class="form-select">
                                <option value="">Seleccione una localidad</option>
                            </select>
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
                            <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/usuario" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin') }}"/>
                            @if ($errors->has('linkedin'))
                                <div class="invalid-feedback">{{ $errors->first('linkedin') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" id="facebook" name="facebook" placeholder="https://facebook.com/usuario" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook') }}"/>
                            @if ($errors->has('facebook'))
                                <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" id="instagram" name="instagram" placeholder="https://instagram.com/usuario" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}"/>
                            @if ($errors->has('instagram'))
                                <div class="invalid-feedback">{{ $errors->first('instagram') }}</div>
                            @endif
                        </div>

                        @if ($errors->has('linkedin') || $errors->has('facebook') || $errors->has('instagram'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('linkedin') ?? $errors->first('facebook') ?? $errors->first('instagram') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title h3">Info Extra</h2>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Foto de perfil</label>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="form-control @error('avatar') is-invalid @enderror"/>
                            @if ($errors->has('avatar'))
                                <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                            @endif
                            <div class="form-text">La imagen debe tener un tamaño entre 100px y 300px de ancho y de alto y no debe pesar más de 500kb</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Biografía *</label>
                            <textarea id="biography"
                                    name="biography"
                                    required
                                    placeholder="Contanos sobre vos..."
                                    rows="4"
                                    class="form-control @error('biography') is-invalid @enderror">{{ old('biography') }}</textarea>
                                    @if ($errors->has('biography'))
                                        <div class="invalid-feedback">{{ $errors->first('biography') }}</div>
                                    @endif
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
