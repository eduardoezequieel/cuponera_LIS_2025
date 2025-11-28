<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                ✏️ Editar Cupón
            </h2>
            <a href="{{ route('company.coupons.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
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
                <form method="POST" class="grid grid-cols-2 gap-3" action="{{ route('company.coupons.update', $coupon) }}">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="col-span-2">
                        <x-input-label for="title" value="Título del Cupón" />
                        <x-text-input id="title" maxlength="255" class="block mt-1 w-full" type="text" name="title" :value="old('title', $coupon->title)" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Regular Price -->
                    <div>
                        <x-input-label for="regular_price" value="Precio Regular ($)" />
                        <x-text-input id="regular_price" class="block mt-1 w-full" type="number" step="0.01" name="regular_price" :value="old('regular_price', $coupon->regular_price)" required autocomplete="regular_price" />
                        <x-input-error :messages="$errors->get('regular_price')" class="mt-2" />
                    </div>

                    <!-- Offer Price -->
                    <div>
                        <x-input-label for="offer_price" value="Precio de Oferta ($)" />
                        <x-text-input id="offer_price" class="block mt-1 w-full" type="number" step="0.01" name="offer_price" :value="old('offer_price', $coupon->offer_price)" required autocomplete="offer_price" />
                        <x-input-error :messages="$errors->get('offer_price')" class="mt-2" />
                    </div>

                    <!-- Start Date -->
                    <div>
                        <x-input-label for="start_date" value="Fecha de Inicio" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', $coupon->start_date->format('Y-m-d'))" required autocomplete="start_date" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        <p class="mt-1 text-sm text-textMuted">Fecha en que el cupón se activa y los clientes pueden empezar a usarlo</p>
                    </div>

                    <!-- End Date -->
                    <div>
                        <x-input-label for="end_date" value="Fecha de Fin" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date', $coupon->end_date->format('Y-m-d'))" required autocomplete="end_date" />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        <p class="mt-1 text-sm text-textMuted">Fecha límite para obtener nuevos cupones (los ya obtenidos siguen válidos)</p>
                    </div>

                    <!-- Redemption Deadline -->
                    <div>
                        <x-input-label for="redemption_deadline" value="Fecha Límite de Canje" />
                        <x-text-input id="redemption_deadline" class="block mt-1 w-full" type="date" name="redemption_deadline" :value="old('redemption_deadline', $coupon->redemption_deadline->format('Y-m-d'))" required autocomplete="redemption_deadline" />
                        <x-input-error :messages="$errors->get('redemption_deadline')" class="mt-2" />
                        <p class="mt-1 text-sm text-textMuted">Fecha límite para usar los cupones ya obtenidos por los clientes</p>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <x-input-label for="quantity" value="Cantidad de Cupones (opcional)" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', $coupon->quantity)" autocomplete="quantity" />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="col-span-2">
                        <x-input-label for="description" value="Descripción" />
                        <x-textarea-input id="description" maxlength="1000" class="block mt-1 w-full" name="description" required autocomplete="description">{{ old('description', $coupon->description) }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="col-span-2">
                        <x-input-label for="status" value="Estado" />
                        <x-select-input id="status" name="status" required>
                            <option value="available" {{ old('status', $coupon->status) === 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="unavailable" {{ old('status', $coupon->status) === 'unavailable' ? 'selected' : '' }}>No Disponible</option>
                        </x-select-input>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex col-span-2 items-center justify-end gap-3 mt-2">
                        <a href="{{ route('company.coupons.index') }}" class="inline-flex items-center px-4 py-2 bg-border hover:bg-border/80 text-white text-sm font-medium rounded-lg transition-colors">
                            Cancelar
                        </a>
                        <x-primary-button>
                            Actualizar Cupón
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>