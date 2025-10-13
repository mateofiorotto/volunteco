<x-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <form method="POST"
          action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <label for="email"
                   class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email"
                   class="block mt-1 w-full"
                   type="email"
                   name="email"
                   required
                   autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>

</x-layout>
