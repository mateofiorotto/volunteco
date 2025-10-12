   <x-layout>
       <form method="POST"
             action="{{ route('login') }}">
           @csrf

           <!-- Email Address -->
           <div>
               <label for="email"
                      class="block text-sm font-medium text-gray-700">Email</label>
               <input id="email"
                      class="block mt-1 w-full"
                      type="email"
                      name="email"
                      :value="old('email')"
                      required
                      autofocus
                      autocomplete="username" />
               <p :messages="$errors->get('email')"
                  class="mt-2"></p>
           </div>

           <!-- Password -->
           <div class="mt-4">
               <label for="password"
                      class="block text-sm font-medium text-gray-700">Contraseña</label>

               <input id="password"
                      class="block mt-1 w-full"
                      type="password"
                      name="password"
                      required
                      autocomplete="current-password" />

               <p :messages="$errors->get('password')"
                  class="mt-2"></p>
           </div>

           <!-- Remember Me -->
           <div class="block mt-4">
               <label for="remember_me"
                      class="inline-flex items-center">
                   <input id="remember_me"
                          type="checkbox"
                          class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                          name="remember">
                   <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
               </label>
           </div>

           <div class="flex items-center justify-end mt-4">
               <button type="submit">
                   Loguearse
               </button>
           </div>
       </form>
   </x-layout>
