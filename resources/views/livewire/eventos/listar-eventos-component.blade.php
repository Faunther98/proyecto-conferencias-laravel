<div>
  
    <div class="mx-auto md:min-h-[500px] sm:px-6 lg:px-8">
        
        <h1>{{ __('Gestión de Eventos') }}</h1>


        <div class="w-full lg:w-[900px] mx-auto">
            <div class="flex justify-end items-center mt-5 mb-2">
                <x-action-button
                    wire:click="$dispatch('abrir-modal-registrar-evento', { idEvento: null })"
                    class="bg-[#74b961] flex items-center gap-2 w-auto px-4 text-base rounded-md">
                    <i class="fa-solid fa-plus"></i>
                    <span>Agregar Evento</span>
                </x-action-button>
            </div>
        </div>

        {{-- 4. Contenedor de la tabla --}}
        <div class="overflow-x-auto">
            <div class="w-full lg:w-[900px] mx-auto my-4">

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-center text-base p-2">Nombre del Evento</th>
                            <th class="text-center text-base p-2">Lugar</th>
                            <th class="text-center text-base p-2">Fechas</th>
                            <th class="text-center text-base p-2">Capacidad</th>
                            <th class="text-center text-base p-2">Estado</th>
                            <th class="text-center text-base p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($this->eventos as $evento)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2 text-center">{{ $evento->nombre }}</td>
                                <td class="p-2 text-center">{{ $evento->lugar }}</td>
                                <td class="p-2 text-center text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} 
                                    <br> al <br> 
                                    {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                                </td>
                                <td class="p-2 text-center">{{ $evento->capacidad }}</td>
                                <td class="p-2 text-center">
                                    <span class="{{ $evento->estado->value == 'S' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded text-xs">
                                        {{ $evento->estado->etiqueta() }}
                                    </span>
                                </td>
                                <td class="p-2">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Botón Sesiones --}}
                                        <a href="{{ route('eventos.sesiones', $evento->id_evento) }}">
                                            <x-action-button class="bg-blue-500" data-tippy="Ver Sesiones">
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </x-action-button>
                                        </a>

                                        {{-- Botón Editar --}}
                                        <x-action-button class="bg-sky-600" data-tippy="Editar" wire:click="$dispatch('abrir-modal-registrar-evento', { idEvento: {{ $evento->id_evento }} })">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </x-action-button>

                                        {{-- Botón Eliminar --}}
                                        <x-action-button class="bg-red-600" data-tippy="Eliminar" wire:click="$dispatch('abrir-modal-eliminar-evento', { idEvento: {{ $evento->id_evento }}, nombreEvento: '{{ $evento->nombre }}' })">
                                            <i class="fa-solid fa-trash"></i>
                                        </x-action-button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-gray-500 italic">No hay eventos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <livewire:eventos.registrar-evento-component />
            <livewire:eventos.eliminar-evento-component/>
        </div>
    </div>
</div>