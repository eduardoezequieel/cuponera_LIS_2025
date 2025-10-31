<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Empresas
            </h2>
            <a href="{{ route('admin.companies.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/80 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nueva Empresa
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
                                Empresa
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                NIT
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Teléfono
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Correo Electrónico
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Verificada
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-textMuted uppercase tracking-wider">
                                Fecha de Creación
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-textMuted uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($companies as $company)
                            <tr class="hover:bg-border/20 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 bg-primary/20 rounded-full flex items-center justify-center">
                                            <span class="text-primary font-medium text-sm">{{ strtoupper(substr($company->company_name, 0, 2)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $company->company_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    {{ $company->nit }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    {{ $company->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    {{ $company->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    @if($company->company_approved)
                                        <span class="inline-flex items-center px-2 py-1 bg-green-600/20 text-green-400 text-xs font-medium rounded-lg">
                                            Verificada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 bg-red-600/20 text-red-400 text-xs font-medium rounded-lg">
                                            No Verificada
                                        </span>
                                    @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textMuted">
                                    {{ $company->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.companies.edit', $company) }}" class="inline-flex items-center gap-1 text-primary hover:text-primary/80 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </a>
                                        @if($company->id !== Auth::id())
                                            <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" onsubmit="return confirm('¿Estás seguro de eliminar este administrador?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 text-red-400 hover:text-red-300 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-textMuted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p class="text-textMuted">No hay compañias registradas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($companies->hasPages())
            <div class="mt-4">
                {{ $companies->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
