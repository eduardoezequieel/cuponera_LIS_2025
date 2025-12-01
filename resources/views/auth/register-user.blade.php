<x-guest-layout title="Registrar usuario">
    <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('register-user') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div>
            <x-input-label for="lastname" :value="__('Apellido')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Nombre de usuario')" />
            <x-text-input id="us    ername" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- dui -->
        <div>
            <x-input-label for="dui" :value="__('DUI')" />
            <x-text-input id="dui" class="block mt-1 w-full" type="text" name="dui" :value="old('dui')" required autofocus autocomplete="dui" />
            <x-input-error :messages="$errors->get('dui')" class="mt-2" />
        </div>

        <!-- birth_date -->
        <div>
            <x-input-label for="birth_date" :value="__('Fecha de nacimiento')" />
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required autofocus autocomplete="birth_date" />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex col-span-full flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6">
            <div class="flex flex-col gap-3 order-2 sm:order-1">
                <a class="underline text-sm text-textMuted hover:text-white transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-secondary" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
                
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-textMuted hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al inicio
                </a>
            </div>

            <x-primary-button class="w-full sm:w-auto order-1 sm:order-2">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>

    <script>        
        document.addEventListener('DOMContentLoaded', () => {
            const duiInput = document.getElementById('dui');
            
            if (duiInput && window.IMask) {
                const maskOptions = {
                    mask: '00000000-0',
                    lazy: false,
                };
                
                const mask = window.IMask(duiInput, maskOptions);
            }
        });
    </script>
</x-guest-layout>
