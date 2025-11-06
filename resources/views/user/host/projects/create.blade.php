@extends('layouts.app')

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

        <form method="POST" action="{{ route('hosts.my-projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Información básica del proyecto -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title h4">Información del Proyecto</h2>

                            <div class="mb-3">
                                <label for="title" class="form-label">Título del proyecto *</label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Ej: Reforestación en la Reserva Natural"
                                       required
                                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" />
                                @if ($errors->has('title'))
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción *</label>
                                <textarea id="description"
                                          name="description"
                                          placeholder="Describe el proyecto, objetivos y actividades a realizar"
                                          rows="5"
                                          required
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="project_type_id" class="form-label">Tipo de proyecto *</label>
                                <select id="project_type_id"
                                        name="project_type_id"
                                        required
                                        class="form-select {{ $errors->has('project_type_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                    @foreach($projectTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('project_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_type_id'))
                                    <p class="text-danger">{{ $errors->first('project_type_id') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicación *</label>
                                <input type="text"
                                       id="location"
                                       name="location"
                                       value="{{ old('location') }}"
                                       placeholder="Ciudad, Provincia"
                                       required
                                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" />
                                @if ($errors->has('location'))
                                    <p class="text-danger">{{ $errors->first('location') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen del proyecto</label>
                                <input type="file"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" />
                                <small class="text-muted">Formatos: JPG, PNG, GIF. Máximo 2MB</small>
                                @if ($errors->has('image'))
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                @endif
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
                                <label for="start_date" class="form-label">Fecha de inicio *</label>
                                <input type="date"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ old('start_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required
                                       class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" />
                                @if ($errors->has('start_date'))
                                    <p class="text-danger">{{ $errors->first('start_date') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">Fecha de finalización *</label>
                                <input type="date"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ old('end_date') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required
                                       class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" />
                                @if ($errors->has('end_date'))
                                    <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="work_hours_per_day" class="form-label">Horas de trabajo por día *</label>
                                <select id="work_hours_per_day"
                                        name="work_hours_per_day"
                                        required
                                        class="form-select {{ $errors->has('work_hours_per_day') ? 'is-invalid' : '' }}">
                                    <option value="">Selecciona las horas</option>
                                    <option value="2 Horas" {{ old('work_hours_per_day') == '2 Horas' ? 'selected' : '' }}>2 Horas</option>
                                    <option value="4 Horas" {{ old('work_hours_per_day') == '4 Horas' ? 'selected' : '' }}>4 Horas</option>
                                    <option value="6 Horas" {{ old('work_hours_per_day') == '6 Horas' ? 'selected' : '' }}>6 Horas</option>
                                    <option value="8 Horas" {{ old('work_hours_per_day') == '8 Horas' ? 'selected' : '' }}>8 Horas</option>
                                </select>
                                @if ($errors->has('work_hours_per_day'))
                                    <p class="text-danger">{{ $errors->first('work_hours_per_day') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Condiciones -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title h4">Condiciones</h3>
                            <p class="text-muted small">Selecciona las condiciones que aplican para este proyecto</p>

                            @foreach($conditions as $condition)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="conditions[]"
                                           value="{{ $condition->id }}"
                                           id="condition_{{ $condition->id }}"
                                           {{ is_array(old('conditions')) && in_array($condition->id, old('conditions')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="condition_{{ $condition->id }}">
                                        {{ $condition->name }}
                                    </label>
                                </div>
                            @endforeach

                            @if ($errors->has('conditions'))
                                <p class="text-danger">{{ $errors->first('conditions') }}</p>
                            @endif
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
                                <label class="form-check-label" for="enabled">
                                    Proyecto habilitado (visible para voluntarios)
                                </label>
                            </div>
                            @if ($errors->has('enabled'))
                                <p class="text-danger">{{ $errors->first('enabled') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3 justify-content-center mt-4 mb-5">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg px-5">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-5 text-capitalize">
                    Crear Proyecto
                </button>
            </div>
        </form>
    </div>
@endsection