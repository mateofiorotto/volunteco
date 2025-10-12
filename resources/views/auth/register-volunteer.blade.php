<x-guest-layout>
    <form method="POST" action="{{ route('register-volunteer.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="email">Email<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="ejemplo@correo.com"
                    required
                    autocomplete="email"
                />

                <label for="password">Contraseña<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu contraseña"
                    required
                    autocomplete="new-password"
                />

                <label for="password_confirmation">Confirmar contraseña<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repite tu contraseña"
                    required
                    autocomplete="new-password"
                />

                <label for="nombre">Nombre<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    placeholder="Tu nombre completo"
                    required
                    autocomplete="name"
                />

                <label for="dni">DNI<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="text"
                    id="dni"
                    name="dni"
                    placeholder="Ej: 12345678"
                    inputmode="numeric"
                    required
                />

                <label for="linkedin">LinkedIn</label>
                <input
                    type="url"
                    id="linkedin"
                    name="linkedin"
                    placeholder="https://linkedin.com/in/usuario"
                />

                <label for="facebook">Facebook</label>
                <input
                    type="url"
                    id="facebook"
                    name="facebook"
                    placeholder="https://facebook.com/usuario"
                />

                <label for="instagram">Instagram</label>
                <input
                    type="url"
                    id="instagram"
                    name="instagram"
                    placeholder="https://instagram.com/usuario"
                />

                <label for="educational_level">Nivel educativo<span class="ml-3 text-xl text-orange-500">*</span></label>
                <select name="educational_level" id="educational_level" required>
                    <option value="" disabled selected>Selecciona un nivel educativo</option>
                    <option value="Secundario">Secundario</option>
                    <option value="Postgrado">Postgrado</option>
                    <option value="Terciario">Terciario</option>
                    <option value="Universitario">Universitario</option>
                </select>

                <label for="profession">Profesión</label>
                <input
                    type="text"
                    id="profession"
                    name="profession"
                    placeholder="Ej: Ingeniero"
                />

                <label for="avatar">Foto de perfil<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input type="file" id="avatar" name="avatar" accept="image/*" />

                <label for="description">Biografía<span class="ml-3 text-xl text-orange-500">*</span></label>
                <textarea
                    id="biography"
                    name="biography"
                    placeholder="Contanos sobre vos..."
                    rows="4"
                ></textarea>

                <label for="birthdate">Fecha de nacimiento<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="date"
                    id="birthdate"
                    name="birthdate"
                    required
                />

                <label for="phone">Teléfono<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="5491112345678"
                    autocomplete="tel"
                />

                <label for="location">Residencia<span class="ml-3 text-xl text-orange-500">*</span></label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    placeholder="Ciudad o provincia"
                    autocomplete="address-level2"
                />

                <button type="submit">Enviar</button>
</x-guest-layout>
