<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h1 class="text-2xl font-bold mb-6">{{ __('Mis Inscripciones') }}</h1>

        <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-center text-base p-2">Evento</th>
                            <th class="text-center text-base p-2">Lugar</th>
                            <th class="text-center text-base p-2">Fechas</th>
                            <th class="text-center text-base p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($this->inscripciones as $inscripcion)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2 text-center font-semibold">{{ $inscripcion->evento->nombre }}</td>
                                <td class="p-2 text-center text-sm">{{ $inscripcion->evento->lugar }}</td>
                                <td class="p-2 text-center text-sm text-gray-600">
                                    {{ $inscripcion->evento->fecha_inicio->format('d/m/Y') }} 
                                    <br> al <br> 
                                    {{ $inscripcion->evento->fecha_fin->format('d/m/Y') }}
                                </td>
                                <td class="p-2 text-center">
                                    <div class="flex items-center justify-center gap-2"> 
                                        
                                        <x-action-button 
                                            class="bg-primario-500 hover:bg-secundario-500" 
                                            data-tippy="Ver sesiones del evento" 
                                            wire:click="$dispatch('abrir-modal-ver-sesiones', { idEvento: {{ $inscripcion->id_evento }} })">
                                            <i class="fa-solid fa-calendar-days text-white"></i>
                                        </x-action-button>
                                
                                        @can('cancelar-inscripcion')
                                            <x-action-button 
                                                class="bg-red-600 hover:bg-red-700" 
                                                data-tippy="Cancelar mi inscripción" 
                                                wire:click="$dispatch('abrir-modal-cancelar-inscripcion', { idInscripcion: {{ $inscripcion->id_inscripcion }}, nombreEvento: '{{ $inscripcion->evento->nombre }}' })">
                                                <i class="fa-solid fa-user-minus"></i>
                                            </x-action-button>
                                        @endcan
                                
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-500 italic">
                                    Aún no te has inscrito a ningún evento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <livewire:inscripciones.cancelar-inscripcion-component />
        <livewire:eventos.ver-sesiones-component/>
        
    </div>
</div>