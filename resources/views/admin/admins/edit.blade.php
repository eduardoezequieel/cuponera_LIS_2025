<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                ✏️ Editar Administrador
            </h2>
            <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
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
                <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('admin.admins.update', $admin) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $admin->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Lastname -->
                    <div>
                        <x-input-label for="lastname" :value="__('Apellido')" />
                        <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname', $admin->lastname)" required autofocus />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="col-span-2">
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $admin->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Nueva Contraseña (opcional)')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        <p class="text-xs text-textMuted mt-1">Déjalo en blanco si no quieres cambiar la contraseña</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar nueva contraseña')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center col-span-2 justify-end gap-3 mt-6">
                        <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Actualizar Administrador') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
