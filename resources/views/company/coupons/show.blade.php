<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalles del Cupón') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('company.coupons.edit', $coupon) }}"
                   class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg shadow hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.536-6.536a2 2 0 112.828 2.828L11.828 15H9v-2z" /></svg>
                    Editar
                </a>
                <a href="{{ route('company.coupons.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-secondary text-white text-sm font-medium rounded-lg shadow hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    Volver al listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-secondary rounded-xl shadow-lg border border-border/50 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Información General</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Título</label>
                                    <p class="text-white">{{ $coupon->title }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Descripción</label>
                                    <p class="text-white">{{ $coupon->description }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Estado</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $coupon->status === 'available' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $coupon->status === 'available' ? 'Disponible' : 'No Disponible' }}
                                    </span>
                                </div>
                                @if($coupon->quantity)
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Cantidad Disponible</label>
                                    <p class="text-white">{{ $coupon->quantity }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Precios</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Precio Regular</label>
                                    <p class="text-white text-lg font-semibold">${{ number_format($coupon->regular_price, 2) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Precio de Oferta</label>
                                    <p class="text-emerald-400 text-lg font-semibold">${{ number_format($coupon->offer_price, 2) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-textMuted">Ahorro</label>
                                    <p class="text-green-400 text-lg font-semibold">
                                        ${{ number_format($coupon->regular_price - $coupon->offer_price, 2) }}
                                        ({{ number_format((($coupon->regular_price - $coupon->offer_price) / $coupon->regular_price) * 100, 1) }}%)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-white mb-2">Fechas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-textMuted">Fecha de Inicio</label>
                                <p class="text-white">{{ $coupon->start_date->isoFormat('DD/MM/YYYY') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-textMuted">Fecha de Fin</label>
                                <p class="text-white">{{ $coupon->end_date->isoFormat('DD/MM/YYYY') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-textMuted">Fecha Límite de Canje</label>
                                <p class="text-white">{{ $coupon->redemption_deadline->isoFormat('DD/MM/YYYY') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-border/50">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-textMuted">Creado el {{ $coupon->created_at->isoFormat('DD/MM/YYYY HH:mm') }}</p>
                            @if($coupon->updated_at != $coupon->created_at)
                            <p class="text-sm text-textMuted">Última actualización {{ $coupon->updated_at->isoFormat('DD/MM/YYYY HH:mm') }}</p>
                            @endif
                        </div>
                        <form action="{{ route('company.coupons.destroy', $coupon) }}" method="POST" class="inline"
                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cupón?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium">
                                Eliminar Cupón
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>