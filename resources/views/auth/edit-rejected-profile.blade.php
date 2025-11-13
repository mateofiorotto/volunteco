@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h1 class="title-h1 h3">Actualiza <span>tu perfil</span></h1>
                    <p>Estimado <span class="fw-semibold fs-5">{{ old('email', $host->email ?? '') }}:</span><br />Completá todos los datos que te pedimos por correo.<br />Luego de enviada tu solicitud, nuestros administradores revisarán tu perfil y serás notificado cuando esté aprobado para que puedas empezar a publicar tus proyectos.</p>
                </div>
            </div>

            {{-- Alerta de errores general --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ocurrió un error.</strong> Por favor, revisá los campos marcados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" novalidate action="{{ route('edit-rejected-profile.update', ['token' => $token, 'email' => $email]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                           class="form-control @error('name') is-invalid @enderror }}"
                                           value="{{ old('name', $host->host->name ?? '') }}"
                                    />
                                    $error('name')
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
                                           class="form-control @error('cuit') is-invalid @enderror"
                                           value="{{ old('cuit', $host->host->cuit ?? '') }}"
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
                                           placeholder="Nombre de persona física para contacto"
                                           autocomplete="name"
                                           class="form-control @error('person_full_name') is-invalid @enderror"
                                           value="{{ old('person_full_name', $host->host->person_full_name ?? '') }}"
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
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $host->host->phone ?? '') }}"
                                    />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="province_id">Provincia</label>
                                    <select name="province_id" id="province_id" class="form-select">
                                        <option value="">Seleccione una provincia</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ $host->host->location && $host->host->location->province_id == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="location_id">Localidad</label>
                                    <select name="location_id" id="location_id" class="form-select">
                                        <option value="">Seleccione una localidad</option>
                                        @if ($host->host->location)
                                            @foreach ($host->host->location->province->locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ $host->host->location_id == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        @endif
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
                                    <label for="linkedin" class="form-label">LinkedIn *</label>
                                    <input type="url"
                                           id="linkedin"
                                           name="linkedin"
                                           placeholder="https://linkedin.com/in/usuario"
                                           class="form-control @error('linkedin') is-invalid @enderror"
                                           value="{{ old('linkedin', $host->host->linkedin ?? '') }}"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook *</label>
                                    <input type="url"
                                           id="facebook"
                                           name="facebook"
                                           placeholder="https://facebook.com/usuario"
                                           class="form-control @error('facebook') is-invalid @enderror"
                                           value="{{ old('facebook', $host->host->facebook ?? '') }}"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram *</label>
                                    <input type="url"
                                           id="instagram"
                                           name="instagram"
                                           placeholder="https://instagram.com/usuario"
                                           class="form-control @error('instagram') is-invalid @enderror"
                                           value="{{ old('instagram', $host->host->instagram ?? '') }}"
                                    />
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
                                <div class="mb-3 d-flex flex-column">
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . ($host->host->avatar ?? 'perfil-host.svg')) }}" width="150" height="150" alt="Foto de perfil" class="object-fit-contain" />
                                    </div>
                                    <label for="avatar" class="form-label">Logo</label>
                                    <input type="file" id="avatar" name="avatar" accept="image/*" class="form-control"/>
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
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $host->host->description ?? '') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center">
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
