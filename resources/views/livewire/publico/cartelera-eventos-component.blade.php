<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      
        <div class="mb-10 text-center">
            <h1> {{ __('Cartelera de Eventos') }}</h1>
        </div>
        <br>
        {{-- Grid responsivo --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse ($eventos as $evento)
                <div class="flex flex-col bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    
                    
                    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                        <div class="flex justify-between items-start gap-2">
                            <h2 class="text-xl font-bold text-gray-800 leading-tight">
                                {{ $evento->nombre }}
                            </h2>

                            {{-- colores de S y N --}}
                            <span class="{{ $evento->estado->value == 'S' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider">
                                {{ $evento->estado->etiqueta() }}
                            </span>
                        </div>
                    </div>

                    {{-- Cuerpo  --}}

                    <div class="p-6 flex-grow space-y-4">
                        <div class="flex items-center text-gray-600 italic">
                            <i class="fa-solid fa-location-dot w-6 text-indigo-500"></i>
                            <span class="text-sm">{{ $evento->lugar }}</span>
                        </div>

                        <div class="flex items-center text-gray-600 italic">
                            <i class="fa-solid fa-calendar-range w-6 text-indigo-500"></i>
                            <span class="text-sm">
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} 
                                al 
                                {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex items-center text-gray-600 italic">
                            <i class="fa-solid fa-users w-6 text-indigo-500"></i>
                            <span class="text-sm">Capacidad: {{ $evento->capacidad }} personas</span>
                        </div>
                    </div>

                    {{-- Pie y botón --}}
                    <div class="p-5 bg-gray-50 border-t border-gray-100">
                        
                        <x-action-button 
                            wire:click="inscribirse({{ $evento->id_evento }})"
                            class="bg-indigo-600 hover:bg-indigo-700 w-full flex justify-center items-center py-2.5 text-sm font-semibold text-white rounded-lg transition-colors">
                            <i class="fa-solid fa-user-plus mr-2"></i>
                            <span>{{ __('Inscribirme al Evento') }}</span>
                        </x-action-button>
                    </div>
                </div>
            @empty
            
                <div class="col-span-full bg-white p-20 rounded-2xl border-2 border-dashed border-gray-200 text-center text-gray-500 italic">
                    <i class="fa-solid fa-calendar-xmark text-4xl mb-4 text-gray-300"></i>
                    <p>Por el momento no hay eventos disponibles.</p>
                </div>
            @endforelse

        </div>
    </div>
</div>