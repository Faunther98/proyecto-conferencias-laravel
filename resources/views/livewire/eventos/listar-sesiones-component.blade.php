<div>
    
    <div class="mx-auto md:min-h-[500px] sm:px-6 lg:px-8">
        
        
        <h1>{{ __('Gestión de Eventos / Sesiones') }}</h1>

        
        <div class="flex justify-between items-center mt-5 mb-4 w-full lg:w-[900px] mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sesiones del Evento: <span class="text-sky-600">{{ $evento->nombre }}</span>
            </h2>
            
            <div class="flex gap-2 items-center">
                {{-- Botón de Regresar  --}}
                <a href="{{ route('eventos.listar') }}" class="inline-flex items-center">
                    <x-secondary-button type="button" class="flex items-center justify-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        <span>Regresar</span>
                    </x-secondary-button>
                </a>

                {{-- Botón nueva sesión --}}
                <x-primary-button
                    type="button"
                    wire:click="$dispatch('abrir-modal-registrar-sesion', { idEvento: {{ $evento->id_evento }} })"
                    class="flex items-center justify-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    <span>Agregar sesión</span>
                </x-primary-button>
            </div>
        </div>


        <div class="overflow-x-auto">
            <div class="w-full lg:w-[900px] mx-auto my-4">
                
                {{-- verifica si hay sesiones --}}
                @if($this->sesiones->count() > 0)
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-center text-base p-2">Fecha</th>
                                <th class="text-center text-base p-2">Horario</th>
                                <th class="text-center text-base p-2">Ponente</th>
                                <th class="text-center text-base p-2">Estado</th>
                                <th class="text-center text-base p-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($this->sesiones as $sesion)
                                <tr class="border-b hover:bg-gray-50">
                                    
                                    <td class="p-2 text-center text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($sesion->fecha)->format('d/m/Y') }}
                                    </td>
                                    
                                    <td class="p-2 text-center text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($sesion->hora_inicio)->format('H:i') }} 
                                        <br> a <br> 
                                        {{ \Carbon\Carbon::parse($sesion->hora_fin)->format('H:i') }}
                                    </td>
                                    
                                    <td class="p-2 text-center">
                                        {{ $sesion->ponente }}
                                    </td>
                                    
                                    <td class="p-2 text-center">
                                        @if($sesion->estado == 'S')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Activa</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactiva</span>
                                        @endif
                                    </td>
                                    
                                    <td class="p-2">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Botón editar --}}
                                            <x-action-button
                                                class="bg-sky-600"
                                                data-tippy="Editar"
                                                wire:click="$dispatch('abrir-modal-registrar-sesion', { idEvento: {{ $evento->id_evento }}, idSesion: {{ $sesion->id_sesion }} })"
                                            >
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </x-action-button>

                                            {{-- Botón eliminar  --}}
                                            <x-action-button 
                                                class="bg-red-600" 
                                                data-tippy="Eliminar"
                                                wire:click="$dispatch('abrir-modal-eliminar-sesion', { idSesion: {{ $sesion->id_sesion }} })"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </x-action-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-8 text-gray-500 italic border p-10 bg-gray-50">
                        Aún no hay sesiones registradas para este evento.
                    </div>
                @endif

            </div>
            

            <livewire:eventos.registrar-sesion-component />
           <livewire:eventos.eliminar-sesion-component /> 
        </div>
    </div>
</div>