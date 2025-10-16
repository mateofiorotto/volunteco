@extends('layouts.app')

@section('content')
    <form method="POST"
          action="{{ route('register-host.store') }}"
          enctype="multipart/form-data">
        @csrf
        <label for="email">Email<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="email"
               id="email"
               name="email"
               placeholder="ejemplo@correo.com"
               required
               autocomplete="email" />

        <label for="password">Contraseña<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="password"
               id="password"
               name="password"
               placeholder="Ingresa tu contraseña"
               required
               autocomplete="new-password" />

        <label for="password_confirmation">Confirmar contraseña<span
                  class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="password"
               id="password_confirmation"
               name="password_confirmation"
               placeholder="Repite tu contraseña"
               required
               autocomplete="new-password" />

        <label for="nombre">Nombre<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="text"
               id="name"
               name="name"
               placeholder="Nombre de organización"
               required
               autocomplete="name" />

        <label for="person_full_name">
            Nombre de persona a contactar<span class="ml-3 text-xl text-orange-500">*</span>
        </label>
        <input type="text"
               id="person_full_name"
               name="person_full_name"
               placeholder="Nombre de persona física para contacto"
               autocomplete="name" />

        <label for="cuit">CUIT<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="text"
               id="cuit"
               name="cuit"
               placeholder="Ej: 20123456789"
               inputmode="numeric"
               required />

        <label for="linkedin">LinkedIn<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="linkedin"
               name="linkedin"
               placeholder="https://linkedin.com/in/usuario" />

        <label for="facebook">Facebook<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="facebook"
               name="facebook"
               placeholder="https://facebook.com/usuario" />

        <label for="instagram">Instagram<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="instagram"
               name="instagram"
               placeholder="https://instagram.com/usuario" />

        <label for="avatar">Foto de perfil<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="file"
               id="avatar"
               name="avatar"
               accept="image/*" />

        <label for="description">Descripción<span class="ml-3 text-xl text-orange-500">*</span></label>
        <textarea id="description"
                  name="description"
                  placeholder="Descripción acerca de la organización/anfitrión"
                  rows="4"></textarea>

        <label for="phone">Teléfono<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="tel"
               id="phone"
               name="phone"
               placeholder="5491112345678"
               autocomplete="tel" />

        <label for="location">Ubicación</label>
        <input type="text"
               id="location"
               name="location"
               placeholder="Ciudad o provincia"
               autocomplete="address-level2" />

        <button type="submit">Enviar</button>
    </form>
@endsection
