<x-layout-admin>
    <section>
        <h2>Verificar perfil de anfitrión</h2>
        <div>
            <ul>
                <li><span class="font-bold">Nombre de ONG/Proyecto del anfitrión: </span>{{ $host->host->name }}</li>
                <li><span class="font-bold">Correo electrónico: </span>{{ $host->email }}</li>
                <li><span class="font-bold">Persona de contacto: </span>{{ $host->host->person_full_name }}</li>
                <li><span class="font-bold">Registrado el: </span>{{ $host->created_at }}</li>
                <li><span class="font-bold">LinkedIn: </span>{{ $host->host->linkedin }}</li>
                <li><span class="font-bold">Instagram: </span>{{ $host->host->instagram }}</li>
                <li><span class="font-bold">Facebook: </span>{{ $host->host->facebook }}</li>
                <li><span class="font-bold">Foto de perfil: </span>{{ $host->host->avatar }}</li>
                <li><span class="font-bold">Descripción: </span>{{ $host->host->description }}</li>
                <li><span class="font-bold">Teléfono: </span>{{ $host->host->phone }}</li>
                <li><span class="font-bold">Ubicación: </span>{{ $host->host->location ?? 'Sin ubicación' }}</li>
                <li><span class="font-bold">Notificado (perfiles desactivados):
                    </span>{{ $host->host->notified ? 'Si' : 'No' }}</li>
                <li><span class="font-bold">Estado: </span>{{ $host->status }}</li>
            </ul>
        </div>
        <div>

            @if ($host->status == 'Pendiente')
                <form method="POST"
                      action="{{ route('accept-host-profile', $host->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Aceptar</button>
                </form>
                <form method="POST"
                      action="{{ route('reject-host-profile', $host->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Rechazar</button>
                </form>
            @elseif ($host->status == 'Inactivo')
                <p>El perfil de anfitrion ha sido desactivado</p>
                {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                <form method="POST"
                      action="{{ route('reactivate-host-profile', $host->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Reactivar</button>
                </form>

                <form method="POST"
                      action="{{ route('pending-host-profile', $host->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Poner en pendiente</button>
                </form>

                <form method="POST"
                      action="{{ route('send-mail-rejected-profile', $host->id) }}">
                    @csrf
                    {{-- enviar mail manualmente con los datos a cambiar y link para reactivar --}}
                    <label>Campos a cambiar</label>
                    <textarea name="description"></textarea>
                    <button type="submit">Enviar mail</button>
                </form>

                <form method="POST"
                      action="{{ route('delete-host-profile', $host->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar definitivamente</button>
                </form>
            @else
                <form method="POST"
                      action="{{ route('disable-host-profile', $host->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Desactivar</button>
                </form>
            @endif
            <a href="{{ route('list-verify-hosts') }}">Volver</a>
        </div>
    </section>
</x-layout-admin>
