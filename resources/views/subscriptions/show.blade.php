<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white px-6 py-5 mx-6 mt-4">
            <div>
                <p class="text-sm font-semibold text-blue-900 uppercase tracking-widest mb-1">Suscripción</p>
                <h2 class="text-lg font-semibold text-slate-900">{{ $subscription->service->name }}</h2>
            </div>
            <a href="{{ route('subscriptions.index') }}"
               class="text-sm font-medium text-blue-800 bg-blue-50 border border-blue-200 hover:bg-blue-100 px-5 py-2 rounded-lg transition">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="p-4 max-w-3xl mx-auto px-6 space-y-4">

            {{-- Precios --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white border border-slate-200 rounded-xl p-4 text-center">
                    <p class="text-xs font-semibold text-blue-400 uppercase tracking-wider mb-2">Total mensual</p>
                    <p class="text-xl font-semibold text-slate-900 tracking-tight">
                        {{ number_format($subscription->price, 2) }}€
                    </p>
                </div>
                <div class="bg-blue-700 rounded-xl p-4 text-center">
                    <p class="text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Por persona</p>
                    <p class="text-xl font-bold text-white tracking-tight">
                        {{ number_format($subscription->price_per_person, 2) }}€
                    </p>
                    <p class="text-md text-blue-300 mt-2">{{ $subscription->total_people }} personas</p>
                </div>
            </div>

            {{-- Integrantes --}}
            <div class="p-4 mt-4 bg-white border border-slate-200 rounded-xl overflow-hidden">

                <div class="flex justify-between items-center px-6 py-5 border-b border-slate-100">
                    <div>
                        <p class="font-semibold text-slate-900">Integrantes</p>
                        <p class="text-xs text-slate-400 mt-0.5">Divide el gasto fácilmente</p>
                    </div>
                    <span class="text-xs font-semibold text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-3 py-1">
                        {{ $subscription->members->count() }}
                    </span>
                </div>

                <div class="px-6 py-4 border-b border-slate-100">
                    <form action="{{ route('members.store', $subscription->id) }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="text" name="name" placeholder="Nombre del integrante..."
                               class="flex-1 bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                               required>
                        <button class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                            Añadir
                        </button>
                    </form>
                </div>

                <div class="px-4 py-2">
                    {{-- Admin --}}
                    <div class="flex justify-between items-center bg-blue-50 rounded-lg px-4 py-3 my-2">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-200 flex items-center justify-center text-xs font-semibold text-blue-800 shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-blue-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-400">Administrador</p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-blue-800">
                            {{ number_format($subscription->price_per_person, 2) }}€
                        </span>
                    </div>

                    {{-- Miembros --}}
                    @foreach($subscription->members as $member)
                    <div class="flex justify-between items-center px-4 py-3 border-b border-slate-100 last:border-none group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-xs font-semibold text-slate-500 shrink-0">
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            </div>
                            <p class="text-sm text-slate-700">{{ $member->name }}</p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-blue-500">
                                {{ number_format($subscription->price_per_person, 2) }}€
                            </span>
                            
                            {{-- BOTÓN ELIMINAR --}}
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Desea eliminar miembro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>