<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Suscripciones
            </h2>
            <a href="{{ route('subscriptions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition shadow-md">
                + Nueva Suscripción
            </a>
        </div>
    </x-slot>

    <div class=" flex justify-content py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100">
                
                @if($subscriptions->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-500 text-lg">Aún no tienes ninguna suscripción registrada.</p>
                        <p class="text-gray-400 text-sm mt-2">Pulsa el botón de arriba para añadir la primera.</p>
                    </div>
                @else
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Servicio</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Precio Total</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Renovación</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Gestión</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($subscriptions as $subscription)
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap font-bold text-gray-900">
                                        {{ $subscription->service->name }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-extrabold text-sm">
                                            {{ number_format($subscription->price, 2) }}€
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-500 text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($subscription->renewal_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right">
                                        {{-- CONTENEDOR DE BOTONES --}}
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('subscriptions.show', $subscription->id) }}" class="inline-flex items-center bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white px-5 py-2 rounded-xl font-bold transition-all border border-indigo-100 shadow-sm text-xs uppercase tracking-tighter">
                                                Dividir Gasto
                                            </a>

                                            {{-- BOTÓN ELIMINAR CON CÍRCULO ROJO --}}
                                            <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('¿Borrar esta suscripción?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-full hover:bg-red-600 hover:text-white border border-red-100 transition-all shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>