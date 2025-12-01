<x-guest-layout title="Registrar compañia">
    <p class="text-sm text-textMuted mb-6">
        ¡Bienvenido al registro de empresas! Completa el formulario a continuación para crear una cuenta de empresa y comenzar a atraer más clientes a tu negocio.
    </p>
    <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('register-company') }}">
        @csrf

        <!-- Company name -->
        <div>
            <x-input-label for="company_name" :value="__('Nombre de la compañia')" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="company_name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <!-- nit -->
        <div>
            <x-input-label for="nit" :value="__('NIT')" />
            <x-text-input 
                id="nit" 
                class="block mt-1 w-full" 
                type="text" 
                name="nit" 
                :value="old('nit')" 
                required 
                autofocus 
                autocomplete="nit"
                placeholder="0000-000000-000-0" 
            />
            <x-input-error :messages="$errors->get('nit')" class="mt-2" />
        </div>

        <!-- phone -->
        <div>
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- address -->
        <div class="col-span-2">
            <x-input-label for="address" :value="__('Dirección')" />
            <x-textarea-input id="address" class="block mt-1 w-full" name="address" required autofocus autocomplete="address">{{ old('address') }}</x-textarea-input>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
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

        <p class="text-sm text-textMuted mt-6 col-span-2">
            Al registrarte, aceptas nuestros Términos y Condiciones y Política de Privacidad. Tu empresa estará sujeta a un proceso de verificación antes de activar la cuenta.
        </p>

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
            const nitInput = document.getElementById('nit');
            const phoneInput = document.getElementById('phone');
            
            if (nitInput && window.IMask) {
                const maskOptions = {
                    mask: '0000-000000-000-0',
                    lazy: false,
                };
                
                const mask = window.IMask(nitInput, maskOptions);
            }

            if (phoneInput && window.IMask) {
                const maskOptions = {
                    mask: '0000-0000',
                    lazy: false,
                };
                
                const mask = window.IMask(phoneInput, maskOptions);
            }
        });
    </script>
</x-guest-layout>
