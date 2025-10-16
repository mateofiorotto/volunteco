   <x-layout>
    <div class="container">
       <form method="POST" action="{{ route('login') }}">
           @csrf

           <!-- Email Address -->
           <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input id="email"
                      class="form-control"
                      type="email"
                      name="email"
                      :value="old('email')"
                      required
                      autofocus
                      autocomplete="username" />
               <p :messages="$errors->get('email')" class="form-text"></p>
           </div>

           <!-- Password -->
           <div class="mb-3">
               <label for="password" class="form-label">Password</label>

               <input id="password"
                      class="form-control"
                      type="password"
                      name="password"
                      required
                      autocomplete="current-password" />

               <p :messages="$errors->get('password')" class="form-text"></p>
           </div>

           <!-- Remember Me -->
           <div class="mb-3 form-check">
                <input id="remember_me"
                        type="checkbox"
                        class="form-check-input"
                        name="remember">

               <label for="remember_me" class="form-check-label">
                   <span class="small">{{ __('Recordarme') }}</span>
               </label>
           </div>

           <div class="d-flex align-items-center justify-content-center mt-4">
               <button type="submit" class="btn btn-primary">Ingresar</button>
               @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu password?') }}
                </a>
            @endif
           </div>
       </form>
    </div>
   </x-layout>
