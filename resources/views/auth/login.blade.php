<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Correo electronico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contrasena" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-gray-800 border-gray-700 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                <span class="ms-2 text-sm text-gray-400">Recordarme</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-400 hover:text-purple-400 transition" href="{{ route('password.request') }}">
                    Olvidaste tu contrasena?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Iniciar Sesion
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">No tienes cuenta?
                <a href="{{ route('register') }}" class="text-purple-400 hover:text-purple-300 transition font-medium">Registrate</a>
            </p>
        </div>
    </form>
</x-guest-layout>
