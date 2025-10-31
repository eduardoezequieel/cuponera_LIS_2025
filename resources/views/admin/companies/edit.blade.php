<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                ✏️ Editar Compañía
            </h2>
            <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('admin.companies.update', $company) }}">
                    @csrf
                    @method('PUT')

                    <!-- Company name -->
                    <div>
                        <x-input-label for="company_name" :value="__('Nombre de la compañía')" />
                        <x-text-input id="company_name" maxlength="255" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $company->company_name)" required autofocus autocomplete="company_name" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <!-- NIT -->
                    <div>
                        <x-input-label for="nit" :value="__('NIT')" />
                        <x-text-input 
                            id="nit" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="nit" 
                            :value="old('nit', $company->nit)" 
                            required 
                            autocomplete="nit"
                            placeholder="0000-000000-000-0" 
                        />
                        <x-input-error :messages="$errors->get('nit')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Teléfono')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $company->phone)" required autocomplete="phone" placeholder="0000-0000" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" maxlength="255" class="block mt-1 w-full" type="email" name="email" :value="old('email', $company->email)" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="col-span-2">
                        <x-input-label for="address" :value="__('Dirección')" />
                        <x-textarea-input id="address" maxlength="255" class="block mt-1 w-full" name="address" required autocomplete="address">{{ old('address', $company->address) }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Company approved (switch component) -->
                    <x-switch id="company_approved" name="company_approved" :checked="old('company_approved', $company->company_approved)" label="Aprobada" helper="Marcar si la compañía está aprobada" />
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Nueva Contraseña (opcional)')" />
                        <x-text-input id="password" maxlength="16" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        <p class="text-xs text-textMuted mt-1">Déjalo en blanco si no quieres cambiar la contraseña</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar nueva contraseña')" />
                        <x-text-input id="password_confirmation" maxlength="16" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center col-span-2 justify-end gap-3 mt-6">
                        <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Actualizar Compañía') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
</x-app-layout>
