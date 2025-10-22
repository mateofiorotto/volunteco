@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3 mb-0">Verificar <span>Anfitrión</span></h1>
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="rounded-2 p-4 border-primary border">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        @if (!empty($host->host->avatar))
                                            <div class="col-md-4">
                                                <img src="{{ asset('storage/' . $host->host->avatar) }}" alt="Foto de perfil" class="img-fluid rounded-start object-fit-cover h-100 w-100"> 
                                            </div>
                                        @endif
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="small text-muted">Anfitrión</div>
                                                    @if ($host->status === 'pendiente')
                                                    <span class="text-uppercase fw-semibold badge text-bg-warning">{{ $host->status }}</span>
                                                    @elseif ($host->status === 'inactivo')
                                                    <span class="text-uppercase fw-semibold badge text-bg-danger">{{ $host->status }}</span>
                                                    @else
                                                    <span class="text-uppercase fw-semibold badge text-bg-primary">{{ $host->status }}</span>
                                                    @endif
                                                </div>
                                                <h2 class="card-title h3">{{ $host->host->name }}</h2>
                                                <ul class="list-unstyled mb-0">
                                                    <li><a href="mailto:{{ $host->email }}" target="_blank">{{ $host->email }}</a></li>
                                                    <li>{{ $host->host->phone }}</li>
                                                    <li>{{ $host->host->location ?? 'Sin ubicación' }}</li>
                                                    <li><span class="text-muted small">Contacto:</span> {{ $host->host->person_full_name }}</li>
                                                    <li><span class="text-muted small">Fecha de registro:</span> {{ $host->created_at->format('d/m/Y') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3" >
                                    <div class="card-header">Descripción</div>
                                    <div class="card-body">
                                        {{ $host->host->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card mb-3" >
                                    <div class="card-header">Redes Sociales</div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <span><i class="bi bi-linkedin fs-5 me-2 text-azul"></i></span>
                                                @if($host->host->linkedin)
                                                <a href="{{$host->host->linkedin}}" target="_blank">{{ $host->host->linkedin }}</a>
                                                @else
                                                Sin datos
                                                @endif
                                            </li>
                                            <li>
                                                <span><i class="bi bi-instagram fs-5 me-2 text-azul"></i></span>
                                                @if ($host->host->instagram )
                                                <a href="{{$host->host->instagram}}" target="_blank">{{ $host->host->instagram }}</a>
                                                @else
                                                Sin datos
                                                @endif
                                            </li>
                                            <li>
                                                <span><i class="bi bi-facebook fs-5 me-2 text-azul"></i></span>
                                                @if ($host->host->facebook)
                                                <a href="{{$host->host->facebook}}" target="_blank">{{ $host->host->facebook }}</a>
                                                @else
                                                Sin datos
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mb-3" >
                        <div class="card-header">Acciones</div>
                        <div class="card-body">

                            {{-- Si el perfil esta pendiente --}}
                            @if ($host->status == 'pendiente')
                                <div>
                                    <form method="POST"
                                        class="d-flex flex-column mb-3"
                                        action="{{ route('send-mail-disabled-profile', $host->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                                            <label class="form-label" for="description">Mensaje:</label>
                                            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                                            <div class="form-text">Indicá los motivos que debe corregir o completar para que podamos aceptar su perfil.</div>
                                        </div>
                                        <button class="btn btn-outline-primary ms-auto"  type="submit">Dejar Pendiente y Enviar Email</button>
                                    </form>
                                </div>

                                <div class="border-top pt-3 d-flex justify-content-between">
                                    <form method="POST"
                                        action="{{ route('disable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-danger" type="submit">Desactivar</button>
                                    </form>
                                    <form method="POST"
                                        action="{{ route('enable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Activar</button>
                                    </form>
                                </div>

                            {{-- Si el perfil esta inactivo --}}
                            @elseif ($host->status == 'inactivo')
                                <p class="alert-danger alert">Este anfitrión está desactivado</p>
                                <div class="d-flex flex-column mb-3">
                                @if($host->host->disabled_at || $host->host->rejection_reason)
                                    <ul class="list-unstyled">
                                        @if($host->host->disabled_at)
                                            <li><span class="text-muted small">Fecha de desactivación:</span> {{ $host->host->disabled_at->format('d/m/Y') }}</li>
                                        @endif
                                        @if($host->host->rejection_reason)
                                            <li><span class="text-muted small">Razón de rechazo:</span> <p class="mb-0">{{ $host->host->rejection_reason }}</p></li>
                                        @endif
                                    </ul>
                                @endif
                                @if($host->host->rejection_reason != null)
                                <form method="POST"
                                    class="ms-auto"
                                    action="{{ route('send-host-rejected-reminder', $host->id) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-outline-primary" type="submit">Enviar Recordatorio</button>
                                </form>
                                @endif
                                </div>

                                <div class="d-flex mb-3 justify-content-between pt-3 border-top">
                                    <form method="POST"
                                        action="{{ route('pending-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-secondary" type="submit">Enviar a Pendiente</button>
                                    </form>

                                    <form method="POST"
                                        action="{{ route('reenable-host-profile', $host->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary" type="submit">Activar</button>
                                    </form>
                                </div>
                                {{-- eliminar perfil definitivamente --}}
                                <div class="pt-3 border-top">
                                    <form method="POST"
                                        class="d-flex flex-column"
                                        action="{{ route('delete-host-profile', $host->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-3">
                                            <label for="delete_reasons" class="form-label">Motivo de eliminación:</label>
                                            <textarea id="delete_reasons" name="delete_reasons" class="form-control"></textarea>
                                            <div class="form-text">Indicá los motivos por los que eliminamos su perfil.</div>
                                        </div>
                                        <button class="btn btn-danger ms-auto" type="submit">Eliminar Definitivamente</button>
                                    </form>
                                </div>
                            {{-- Si el perfil esta activo --}}
                            @else
                            <div>
                                <form method="POST"
                                    class="d-flex flex-column mb-3"
                                    action="{{ route('send-mail-disabled-profile', $host->id) }}">
                                    @csrf
                                    <div class="mb-3">
                                        {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                                        <label for="description" class="form-label">Mensaje:</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                        <div class="form-text">Indicá los motivos por los que no podemos aceptar su perfil.</div>
                                    </div>
                                    <button class="btn btn-outline-primary ms-auto" type="submit">Rechazar y Enviar Email</button>
                                </form>
                            </div>
                            <div class="border-top pt-3 d-flex justify-content-between">
                                <form method="POST"
                                    action="{{ route('disable-host-profile', $host->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-outline-danger" type="submit">Desactivar</button>
                                </form>
                                <form method="POST"
                                    action="{{ route('pending-host-profile', $host->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-danger" type="submit">Enviar a Pendiente</button>
                                </form>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none">
                <div class="card">
                    Listado de proyectos
                </div>

            </div>
        </div>
    </section>
@endsection
