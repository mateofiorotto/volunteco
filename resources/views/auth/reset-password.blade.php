<x-layout>
    <form method="POST"
          action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden"
               name="token"
               value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email"
                   :value="__('Email')">Email</label>
            <input id="email"
                   class="block mt-1 w-full"
                   type="email"
                   name="email"
                   value="{{ $request->email }}"
                   required
                   autofocus
                   autocomplete="username" />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password"
                   :value="__('Password')">Password</label>
            <input id="password"
                   class="block mt-1 w-full"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password" />

        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation"
                   :value="__('Confirm Password')"></label>

            <input id="password_confirmation"
                   class="block mt-1 w-full"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-layout>
