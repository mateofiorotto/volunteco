<x-layout>
    <h2>Modifica tu perfil</h2>
    <form method="POST"
          action="{{ route('edit-rejected-profile.update', ['token' => $token, 'email' => $email]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p>{{ old('email', $host->email ?? '') }}</p>

        <label for="nombre">Nombre<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="text"
               id="name"
               name="name"
               placeholder="Nombre de organización"
               required
               autocomplete="name"
               value="{{ old('name', $host->host->name ?? '') }}" />

        <label for="person_full_name">
            Nombre de persona a contactar<span class="ml-3 text-xl text-orange-500">*</span>
        </label>
        <input type="text"
               id="person_full_name"
               name="person_full_name"
               placeholder="Nombre de persona física para contacto"
               autocomplete="name"
               value="{{ old('person_full_name', $host->host->person_full_name ?? '') }}" />

        <label for="cuit">CUIT<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="text"
               id="cuit"
               name="cuit"
               placeholder="Ej: 20123456789"
               inputmode="numeric"
               required 
               value="{{ old('cuit', $host->host->cuit ?? '') }}"/>

        <label for="linkedin">LinkedIn<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="linkedin"
               name="linkedin"
               placeholder="https://linkedin.com/in/usuario" 
               value="{{ old('linkedin', $host->host->linkedin ?? '') }}"/>

        <label for="facebook">Facebook<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="facebook"
               name="facebook"
               placeholder="https://facebook.com/usuario" 
               value="{{ old('facebook', $host->host->facebook ?? '') }}"/>

        <label for="instagram">Instagram<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="url"
               id="instagram"
               name="instagram"
               placeholder="https://instagram.com/usuario" 
               value="{{ old('instagram', $host->host->instagram ?? '') }}"/>

        <label for="avatar">Foto de perfil<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="file"
               id="avatar"
               name="avatar"
               accept="image/*" />
        <img src="{{ asset('storage/' . $host->host->avatar) }}" alt="Foto de perfil" />

        <label for="description">Descripción<span class="ml-3 text-xl text-orange-500">*</span></label>
        <textarea id="description"
                  name="description"
                  placeholder="Descripción acerca de la organización/anfitrión"
                  rows="4">{{ old('description', $host->host->description ?? '') }}</textarea>
                  

        <label for="phone">Teléfono<span class="ml-3 text-xl text-orange-500">*</span></label>
        <input type="tel"
               id="phone"
               name="phone"
               placeholder="5491112345678"
               autocomplete="tel" 
               value="{{ old('phone', $host->host->phone ?? '') }}"/>

        <label for="location">Ubicación</label>
        <input type="text"
               id="location"
               name="location"
               placeholder="Ciudad o provincia"
               autocomplete="address-level2" 
               value="{{ old('location', $host->host->location ?? '') }}"/>

        <button type="submit">Enviar</button>
    </form>
</x-layout>
