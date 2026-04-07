<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nombre Completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8 space-y-6">
            <div class="flex items-center justify-between">
                <a class="text-sm text-gray-600 hover:text-blue-600 underline" href="{{ route('login') }}">
                    ¿Ya tienes una cuenta?
                </a>

                <x-primary-button class="ms-4 bg-blue-600 hover:bg-blue-700 px-6 py-3 shadow-lg">
                    Crear mi Cuenta
                </x-primary-button>
            </div>

            <p class="text-center text-xs text-gray-400 mt-4">
                Al registrarte, aceptas nuestros términos de servicio y la gestión de gastos compartidos.
            </p>
        </div>
    </form>
</x-guest-layout>
