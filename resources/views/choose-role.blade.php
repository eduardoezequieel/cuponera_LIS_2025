<x-guest-layout title="Elige tu cuenta">
    <div class="space-y-6">
        <div class="text-center">
            <h3 class="text-xl font-bold text-white mb-2">¿Qué tipo de cuenta necesitas?</h3>
            <p class="text-sm text-textMuted">Selecciona la opción que mejor se adapte a ti</p>
        </div>

        <!-- Cliente Card -->
        <a href="{{ route('register-user') }}" class="block">
            <div class="bg-border/30 hover:bg-border/50 border-2 border-border hover:border-primary/50 rounded-xl p-6 transition-all duration-200 hover:scale-105 cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/20 group-hover:bg-primary/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-white mb-1 group-hover:text-primary transition-colors">Soy Cliente</h4>
                        <p class="text-sm text-textMuted">Quiero comprar cupones y ahorrar en mis lugares favoritos</p>
                        <div class="mt-3 flex items-center gap-2 text-xs text-primary">
                            <span>Registrarme como cliente</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Empresa Card -->
        <a href="{{ route('register-company') }}" class="block">
            <div class="bg-border/30 hover:bg-border/50 border-2 border-border hover:border-primary/50 rounded-xl p-6 transition-all duration-200 hover:scale-105 cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/20 group-hover:bg-primary/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-white mb-1 group-hover:text-primary transition-colors">Soy Empresa</h4>
                        <p class="text-sm text-textMuted">Quiero vender cupones y atraer más clientes a mi negocio</p>
                        <div class="mt-3 flex items-center gap-2 text-xs text-primary">
                            <span>Registrarme como empresa</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Divider -->
        <div class="flex items-center gap-4 py-4">
            <div class="flex-1 border-t border-border/50"></div>
            <span class="text-xs text-textMuted">o</span>
            <div class="flex-1 border-t border-border/50"></div>
        </div>

        <!-- Login Link -->
        <div class="text-center space-y-3">
            <p class="text-sm text-textMuted">¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}" class="inline-block">
                <button class="inline-flex items-center gap-2 px-6 py-2 text-sm text-textMuted hover:text-white border border-border hover:border-primary/50 rounded-lg transition-all hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Iniciar sesión
                </button>
            </a>
        </div>
    </div>
</x-guest-layout>