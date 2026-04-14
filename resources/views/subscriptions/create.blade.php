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
                        <div class="mb-3">
                            <label for="renewal_date" class="form-label">Fecha de renovación</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="3"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('renewal_date') is-invalid @enderror"
                                    id="renewal_date"
                                    name="renewal_date"
                                    value="{{ old('renewal_date') }}"
                                    placeholder="DD/MM/AAAA"
                                    readonly>
                                <button class="btn btn-outline-secondary" type="button" id="clear_date" title="Limpiar fecha">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                                @error('renewal_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Selecciona o escribe la fecha de renovación</div>
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
