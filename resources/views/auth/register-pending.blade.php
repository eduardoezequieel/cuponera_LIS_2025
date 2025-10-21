<x-guest-layout title="Registro Pendiente">
    <div class="text-center space-y-6">
        <!-- Icono de éxito -->
        <div class="flex justify-center">
            <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Mensaje principal -->
        <div class="space-y-3">
            <h2 class="text-2xl font-bold text-white">¡Registro Exitoso!</h2>
            <p class="text-textMuted">
                Tu cuenta de empresa ha sido creada correctamente.
            </p>
        </div>

        <!-- Información de estado -->
        <div class="bg-primary/10 border border-primary/30 rounded-xl p-4 space-y-2">
            <div class="flex items-center justify-center gap-2 text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold">Pendiente de Aprobación</span>
            </div>
            <p class="text-sm text-textMuted">
                Un administrador revisará tu solicitud pronto. 
                Te notificaremos por correo electrónico cuando tu cuenta sea aprobada.
            </p>
        </div>

        <!-- Información adicional -->
        <div class="text-sm text-textMuted space-y-2">
            <p>Esto generalmente toma entre 24 a 48 horas.</p>
            <p>Si tienes preguntas, contáctanos a: 
                <a href="mailto:soporte@lacuponerasv.com" class="text-primary hover:underline">
                    soporte@lacuponerasv.com
                </a>
            </p>
        </div>

        <!-- Botón de inicio -->
        <div class="pt-4">
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/80 text-white font-bold rounded-xl transition-all">
                Volver al inicio de sesión
            </a>
        </div>
    </div>
</x-guest-layout>