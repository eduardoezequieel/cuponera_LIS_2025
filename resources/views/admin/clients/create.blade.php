<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                ➕ Nuevo Cliente
            </h2>
            <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
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
                <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('admin.clients.store') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" maxlength="100" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Lastname -->
                    <div>
                        <x-input-label for="lastname" :value="__('Apellido')" />
                        <x-text-input id="lastname" maxlength="100" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>

                    <!-- Username -->
                    <div>
                        <x-input-label for="username" :value="__('Usuario')" />
                        <x-text-input id="username" maxlength="100" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" maxlength="100" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- DUI -->
                    <div>
                        <x-input-label for="dui" :value="__('DUI (opcional)')" />
                        <x-text-input id="dui" maxlength="10" class="block mt-1 w-full" type="text" name="dui" :value="old('dui')" />
                        <x-input-error :messages="$errors->get('dui')" class="mt-2" />
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <x-input-label for="birth_date" :value="__('Fecha de Nacimiento (opcional)')" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" max="{{ date('Y-m-d', strtotime('-1 day')) }}" />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" maxlength="16" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                        <x-text-input id="password_confirmation" maxlength="16" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex col-span-2 items-center justify-end gap-3 mt-2">
                        <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Crear Cliente') }}
                        </x-primary-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>
