<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Mis Cupones') }}
            </h2>
            <a href="{{ route('company.coupons.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/80 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear Nuevo Cupón
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 bg-green-600/20 border border-green-600/50 text-green-400 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-600/20 border border-red-600/50 text-red-400 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-secondary rounded-xl shadow-lg border border-border/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border">
                    <thead class="bg-border/30">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Cupón
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Precio Regular
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Precio Oferta
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Fecha Fin
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-textMuted uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($coupons as $coupon)
                            <tr class="hover:bg-border/20 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 bg-primary/20 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $coupon->title }}</div>
                                            <div class="text-sm text-textMuted">{{ Str::limit($coupon->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    ${{ number_format($coupon->regular_price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-400 font-bold">
                                    ${{ number_format($coupon->offer_price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($coupon->status === 'available')
                                        <span class="inline-flex items-center px-2 py-1 bg-green-600/20 text-green-400 text-xs font-medium rounded-lg">
                                            Disponible
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 bg-red-600/20 text-red-400 text-xs font-medium rounded-lg">
                                            No Disponible
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    {{ $coupon->end_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('company.coupons.show', $coupon) }}" class="inline-flex items-center gap-1 text-primary hover:text-primary/80 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Ver
                                        </a>
                                        <a href="{{ route('company.coupons.edit', $coupon) }}" class="inline-flex items-center gap-1 text-yellow-400 hover:text-yellow-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('company.coupons.destroy', $coupon) }}" onsubmit="return confirm('¿Estás seguro de eliminar este cupón?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-red-400 hover:text-red-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <p class="text-textMuted">No tienes cupones creados aún.</p>
                                        <a href="{{ route('company.coupons.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/80 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Crear tu primer cupón
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($coupons->hasPages())
            <div class="mt-4">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>
</x-app-layout>