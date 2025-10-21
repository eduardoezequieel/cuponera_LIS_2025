<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-white">
            {{ __("You're logged in!") }}
        </div>
    </div>
</x-app-layout>
