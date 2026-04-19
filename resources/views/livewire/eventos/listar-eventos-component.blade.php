<div>
    <div class="flex justify-end items-center mt-5 mb-2">
        <x-action-button
            wire:click="$dispatch('abrir-modal-registrar-evento', { idEvento: null })"
            class="bg-[#74b961] flex items-center gap-2 w-auto px-4 text-base rounded-md">
            <i class="fa-solid fa-plus"></i>
            <span>Agregar Evento</span>
        </x-action-button>
    </div>

    <div class="overflow-x-auto">
            <div class="w-full lg:w-[900px] mx-auto my-4">

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-centrado text-base p-2">Nombre del Evento</th>
                            <th class="text-centrado text-base p-2">Lugar</th>
                            <th class="text-centrado text-base p-2">Fecha Inicio</th>
                            <th class="text-centrado text-base p-2">Capacidad</th>
                            <th class="text-centrado text-base p-2">Estado</th>
                            <th class="text-centrado text-base p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($this->eventos as $evento)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-2 text-center">
                                    {{ $evento->nombre }}
                                </td>

                                <td class="p-2 text-center">
                                    {{ $evento->lugar }}
                                </td>

                                <td class="p-2 text-center text-sm text-gray-600">
                                    {{ $evento->fecha_inicio }} <br> al <br> {{ $evento->fecha_fin }}
                                </td>

                                <td class="p-2 text-center">
                                    {{ $evento->capacidad }}

                                </td>

                                <td class="p-2 text-center">
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                        {{ $evento->estado->etiqueta() }}
                                    </span>
                                </td>

                                <td class="p-2">
                                    <div class="flex items-center justify-center gap-2">

                                        <x-action-button
                                            class="bg-sky-600"
                                            data-tippy="Editar"
                                            wire:click="$dispatch('abrir-modal-registrar-evento', { idEvento: {{ $evento->id_evento }} })"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </x-action-button>

                                        <x-action-button 
                                            class="bg-red-600" 
                                            data-tippy="Eliminar"
                                            wire:click="$dispatch('abrir-modal-eliminar-evento', { idEvento: {{ $evento->id_evento }}, nombre: '{{ $evento->nombre }}' })"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </x-action-button>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-500 italic">
                                    No hay eventos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <livewire:eventos.registrar-evento-component />
        </div>

</div>