<x-guest-layout>
    <div class="flex min-h-[80vh]">
        <!-- Lado del formulario -->
        <div class="w-full max-w-xl flex flex-col justify-start items-center bg-white shadow-lg px-12 py-10 mt-12 rounded-lg">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 mx-auto" style="height:300px; width: 300px;">
            </div>
            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Has olvidado tu contraseña?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <!-- Lado de la imagen -->
        <div class="hidden md:flex flex-1 items-center justify-center bg-gray-100">
            <img src="{{ asset('img/warhammer_portada.png') }}" alt="Imagen lateral" class="object-cover h-full w-full">
        </div>
    </div>
</x-guest-layout>
