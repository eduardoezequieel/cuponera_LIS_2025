<x-guest-layout title="Cuenta no autorizada">
    <div class="text-center">
        <div class="mb-6">
            <svg class="w-20 h-20 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-white mb-4">
            🔒 Cuenta en proceso de aprobación
        </h2>

        <p class="text-textMuted mb-6 leading-relaxed">
            Tu cuenta de empresa ha sido registrada exitosamente, pero aún está pendiente de aprobación por parte de nuestro equipo administrativo.
        </p>

        <div class="bg-secondary/50 border border-border rounded-lg p-4 mb-6">
            <p class="text-sm text-textMuted">
                <strong class="text-white">¿Qué significa esto?</strong><br>
                Nuestro equipo está revisando la información de tu empresa para garantizar la calidad y seguridad de nuestra plataforma. 
                Este proceso generalmente toma entre 24 a 48 horas hábiles.
            </p>
        </div>

        <p class="text-sm text-textMuted mb-8">
            Recibirás un correo electrónico una vez que tu cuenta haya sido aprobada y puedas acceder a todas las funcionalidades de La Cuponera SV.
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-primary-button class="w-full sm:w-auto">
                {{ __('Cerrar sesión') }}
            </x-primary-button>
        </form>

        <div class="mt-6">
            <p class="text-xs text-textMuted">
                ¿Necesitas ayuda? Contáctanos a 
                <a href="mailto:soporte@lacuponerasv.com" class="text-primary hover:underline">soporte@lacuponerasv.com</a>
            </p>
        </div>
    </div>
</x-guest-layout>
