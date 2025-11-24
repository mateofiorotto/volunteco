@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-md-7">
                <h1 class="title-h1 h3 mb-0">Crear <span>Proyecto</span></h1>
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
              action="{{ route('host.my-projects.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Información básica del proyecto -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title h4">Información del Proyecto</h2>

                            <div class="mb-3">
                                <label for="title"
                                       class="form-label">Título del proyecto *</label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Ej: Reforestación en la Reserva Natural"
                                       required
                                       class="form-control @error('title') is-invalid @enderror }}" />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description"
                                       class="form-label">Descripción *</label>
                                <textarea id="description"
                                          name="description"
                                          placeholder="Describe el proyecto, objetivos y actividades a realizar"
                                          rows="5"
                                          required
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="project_type_id"
                                       class="form-label">Tipo de proyecto *</label>
                                <select id="project_type_id"
                                        name="project_type_id"
                                        required
                                        class="form-select @error('project_type_id') is-invalid @enderror">
                                    <option value=""
                                            disabled
                                            selected>Selecciona un tipo</option>
                                    @foreach ($projectTypes as $type)
                                        <option value="{{ $type->id }}"
                                                {{ old('project_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_type_id')
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

                            <div class="mb-3">
                                <label for="image"
                                       class="form-label">Imagen del proyecto</label>
                                <input type="file"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       class="form-control @error('image') is-invalid @enderror" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">La imagen no debe superar 860px de ancho ni 480px de alto y no debe
                                    pesar más de 300kb</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fechas y horarios -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title h4">Fechas y Horarios</h3>

                            <div class="mb-3">
                                <label for="start_date"
                                       class="form-label">Fecha de inicio *</label>
                                <input type="date"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ old('start_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required
                                       class="form-control @error('start_date') is-invalid @enderror" />
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_date"
                                       class="form-label">Fecha de finalización *</label>
                                <input type="date"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ old('end_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required
                                       class="form-control @error('end_date') is-invalid @enderror" />
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="work_hours_per_day"
                                       class="form-label">Horas de trabajo por día *</label>
                                <select id="work_hours_per_day"
                                        name="work_hours_per_day"
                                        required
                                        class="form-select @error('work_hours_per_day') is-invalid @enderror">
                                    <option value="">Selecciona las horas</option>
                                    <option value="2 Horas"
                                            {{ old('work_hours_per_day') == '2 Horas' ? 'selected' : '' }}>2 Horas</option>
                                    <option value="4 Horas"
                                            {{ old('work_hours_per_day') == '4 Horas' ? 'selected' : '' }}>4 Horas</option>
                                    <option value="6 Horas"
                                            {{ old('work_hours_per_day') == '6 Horas' ? 'selected' : '' }}>6 Horas</option>
                                    <option value="8 Horas"
                                            {{ old('work_hours_per_day') == '8 Horas' ? 'selected' : '' }}>8 Horas</option>
                                </select>
                                @error('work_hours_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Condiciones -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title h4">Condiciones</h3>
                            <p class="text-muted small">Selecciona las condiciones que aplican para este proyecto</p>

                            @foreach ($conditions as $condition)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="conditions[]"
                                           value="{{ $condition->id }}"
                                           id="condition_{{ $condition->id }}"
                                           {{ is_array(old('conditions')) && in_array($condition->id, old('conditions')) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                           for="condition_{{ $condition->id }}">
                                        {{ $condition->name }}
                                    </label>
                                </div>
                            @endforeach

                            @error('condition')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title h4">Estado</h3>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="enabled"
                                       id="enabled"
                                       value="1"
                                       {{ old('enabled', true) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                       for="enabled">
                                    Deshabilitado / Habilitado
                                </label>
                            </div>
                            @error('enabled')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Habilite el proyecto para que quede publicado y visible para los
                                voluntarios</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3 justify-content-center mt-4 mb-5">
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary btn-lg px-5">
                    Cancelar
                </a>
                <button type="submit"
                        class="btn btn-primary btn-lg px-5 text-capitalize">
                    Crear
                </button>
            </div>
        </form>
    </div>
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
