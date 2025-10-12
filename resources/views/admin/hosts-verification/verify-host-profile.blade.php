<body>
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
        </ul>
    </div>
    <div>
        @if($host->enabled == false)
        <form method="POST" action="/admin/verificar-perfil-anfitrion/{{ $host->id }}/aceptar">
            @csrf
            @method('PUT')
            <button type="submit">Aceptar</button>
        </form>
        <form method="POST" action="/admin/verificar-perfil-anfitrion/{{ $host->id }}/rechazar">
            @csrf
            @method('DELETE')
            <button type="submit">Rechazar</button>
        </form>
        @else
        <form method="POST" action="/admin/verificar-perfil-anfitrion/{{ $host->id }}/desactivar">
            @csrf
            @method('PUT')
            <button type="submit">Desactivar</button>
        </form>
        @endif
        <a href="/admin/lista-verificacion-anfitriones">Volver</a>
    </div>
</section>