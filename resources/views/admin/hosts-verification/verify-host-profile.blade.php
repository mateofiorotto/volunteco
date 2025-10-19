@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <h1 class="title-h1 h3 mb-5">Verificar <span>perfil de anfitrión</span></h1>
            <div>
                <ul class="list-unstyled">
                    <li><span>Nombre del anfitrión: </span>{{ $host->host->name }}</li>
                    <li><span>Email: </span><a href="mailto:{{ $host->email }}" target="_blank">{{ $host->email }}</a></li>
                    <li><span>Persona de contacto: </span>{{ $host->host->person_full_name }}</li>
                    <li><span>Registrado el: </span>{{ $host->created_at }}</li>
                    <li><span>LinkedIn: </span>{{ $host->host->linkedin }}</li>
                    <li><span>Instagram: </span>{{ $host->host->instagram }}</li>
                    <li><span>Facebook: </span>{{ $host->host->facebook }}</li>
                    <li><span>Foto de perfil: </span>{{ $host->host->avatar }}</li>
                    <li><span>Descripción: </span>{{ $host->host->description }}</li>
                    <li><span>Teléfono: </span>{{ $host->host->phone }}</li>
                    <li><span>Ubicación: </span>{{ $host->host->location ?? 'Sin ubicación' }}</li>
                    <li><span>Foto de perfil: </span><img src="{{ asset('storage/' . $host->host->avatar) }}" alt="Foto de perfil"></li>
                    @if($host->host->disabled_at != null)
                        <li><span class="font-bold">Fecha de desactivación: </span>{{ $host->host->disabled_at }}</li>
                    @endif
                    @if($host->host->rejection_reason != null)
                        <li><span class="font-bold">Razón de rechazo: </span>{{ $host->host->rejection_reason }}</li>
                    @endif
                    <li><span class="font-bold">Estado: </span>{{ $host->status }}</li>
                </ul>
            </div>
            <div>
            {{-- Si el perfil esta pendiente --}}
                @if ($host->status == 'Pendiente')
                    <form method="POST"
                        action="{{ route('enable-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="bg-green-600 p-4 text-white font-bold uppercase text-xl" type="submit">Aceptar</button>
                    </form>
                    <form method="POST"
                        action="{{ route('send-mail-disabled-profile', $host->id) }}">
                        @csrf
                        {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                        <label for="description">Campos a cambiar</label>
                        <textarea id="description" name="description"></textarea>
                        <button class="bg-red-500 p-4 text-white font-bold uppercase text-xl" type="submit">Rechazar y enviar mail</button>
                    </form>
                    <form method="POST"
                        action="{{ route('disable-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="border-4 border-red-500 p-4 text-red-500 font-bold uppercase text-xl" type="submit">Rechazar/Desactivar sin avisar</button>
                    </form>
                @elseif ($host->status == 'Inactivo')
                    <p>El perfil de anfitrion ha sido desactivado</p>
                    {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                    <form method="POST"
                        action="{{ route('reenable-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="bg-green-600 p-4 text-white font-bold uppercase text-xl" type="submit">Reactivar</button>
                    </form>
                    <form method="POST"
                        action="{{ route('pending-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="bg-yellow-500 p-4 text-white font-bold uppercase text-xl" type="submit">Poner en pendiente</button>
                    </form>
                    @if($host->host->rejection_reason != null)
                    <form method="POST"
                        action="{{ route('send-host-rejected-reminder', $host->id) }}">
                        @csrf
                        @method('POST')
                        <button class="bg-yellow-500 p-4 text-white font-bold uppercase text-xl" type="submit">Enviar recordatorio</button>
                    </form>
                    @endif
                    {{-- eliminar perfil definitivamente --}}
                    <form method="POST"
                        action="{{ route('delete-host-profile', $host->id) }}">
                        @csrf
                        @method('DELETE')
                        <label for="delete_reasons">Motivo de eliminación</label>
                        <textarea id="delete_reasons" name="delete_reasons"></textarea>
                        <button class="bg-red-500 p-2 text-white font-bold uppercase text-xl" type="submit">Eliminar definitivamente</button>
                    </form>
                @else
                    <form method="POST"
                        action="{{ route('pending-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="bg-yellow-500 p-4 text-white font-bold uppercase text-xl" type="submit">Poner en pendiente</button>
                    </form>
                    <form method="POST"
                        action="{{ route('send-mail-disabled-profile', $host->id) }}">
                        @csrf
                        {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                        <label for="description">Campos a cambiar</label>
                        <textarea name="description" id="description"></textarea>
                        <button class="bg-red-500 p-4 text-white font-bold uppercase text-xl" type="submit">Rechazar y enviar mail</button>
                    </form>
                    <form method="POST"
                        action="{{ route('disable-host-profile', $host->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="border-4 border-red-500 p-4 text-red-500 font-bold uppercase text-xl" type="submit">Rechazar/Desactivar sin avisar</button>
                    </form>
                @endif
                <a href="{{ route('list-verify-hosts') }}">Volver</a>
            </div>
        </div>
    </section>
@endsection
