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
                            <label for="renewal_date" class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-3">Fecha de Renovación</label>
                            
                            <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                            </div>
                                <input
                                    datepicker
                                    type="text"
                                    class="w-full ps-9 pe-3 py-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg"
                                    placeholder="Selecciona fecha"
                                />                         
                            </div>

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
