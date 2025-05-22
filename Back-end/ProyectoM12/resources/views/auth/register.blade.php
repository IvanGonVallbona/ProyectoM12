<x-guest-layout>
    <div class="flex min-h-[80vh]">
        <!-- Lado del formulario -->
        <div class="w-full max-w-xl flex flex-col justify-center items-center bg-white px-12 py-10 my-auto rounded-lg">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 mx-auto" style="height:300px; width: 300px;">
            </div>
            <!-- Formulario -->
            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="'Nombre'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="'Contraseña'" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="'Confirmar contraseña'" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        ¿Ya tienes cuenta?
                    </a>
                    <x-primary-button class="ms-4">
                        Registrarse
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
