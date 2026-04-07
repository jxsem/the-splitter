<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Añadir Nueva Suscripción
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 shadow-lg rounded-2xl border border-gray-100">
                
                <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6"> {{-- Contenedor padre para asegurar el ritmo --}}
                        {{-- 1. PLATAFORMA --}}
                        <div>
                            <label for="service_id" class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-3">Plataforma Digital</label>
                            <select name="service_id" id="service_id" class="w-full bg-slate-50 border-gray-100 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 py-4 px-4 text-sm font-bold text-slate-700 transition-all">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 2. PRECIO --}}
                        <div>
                            <label for="price" class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-3">Precio Recurrente (€)</label>
                            <input type="number" step="0.01" name="price" id="price" placeholder="0.00" class="w-full bg-slate-50 border-gray-100 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 py-4 px-4 text-sm font-bold text-slate-700 transition-all" required>
                        </div>
                        {{-- 3. PERIODO --}}
                        <div>
                            <label for="period" class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-3">Periodo de Facturación</label>
                            <select name="period" id="period" class="w-full bg-slate-50 border-gray-100 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 py-4 px-4 text-sm font-bold text-slate-700 transition-all">
                                <option value="monthly">Mensual</option>
                                <option value="trimesterly">Trimestral</option>
                                <option value="annually">Anual</option>
                            </select>
                        </div>
                        {{-- 4. FECHA DE RENOVACIÓN --}}
                        <div>
                            <label for="renewal_date" class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-3">Próxima Renovación</label>
                            <input type="date" name="renewal_date" id="renewal_date" 
                                value="{{ date('Y-m-d') }}"
                                class="w-full bg-slate-50 border-gray-100 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 py-4 px-4 text-sm font-bold text-slate-700 transition-all" required>
                        </div>
                        {{-- 5. BOTÓN GUARDAR --}}
                        <div>
                            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-4 px-4 rounded-xl text-sm font-bold transition-all">
                                Guardar Suscripción
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>