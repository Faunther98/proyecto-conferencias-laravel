<div>
    <x-dialog-modal wire:model="modalAbierto">

        <x-slot name="title">
            <span class="text-primario-100 font-bold">{{ $eventoSeleccionado?->nombre }}</span>
        </x-slot>

        <x-slot name="content">
            {{-- Info general del lugar --}}
            <div class="mb-5 p-3 bg-blue-50 border-l-4 border-primario-500 text-sm text-primario-500">
                <i class="fa-solid fa-circle-info mr-2 text-primario-500"></i>
                Este evento se llevará a cabo en: <strong>{{ $eventoSeleccionado?->lugar }}</strong>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <thead class="bg-primario-500">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Título de la Sesión</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Fecha</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Horario</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Ponente</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($eventoSeleccionado && $eventoSeleccionado->sesiones->where('estado', 'S')->count() > 0)
                            @foreach($eventoSeleccionado->sesiones->where('estado', 'S') as $sesion)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Título --}}
                                    <td class="px-4 py-3 text-sm text-center font-semibold text-gray-800">
                                        {{ $sesion->nombre }}
                                    </td>

                                    {{-- Fecha --}}
                                    <td class="px-4 py-3 text-sm text-center text-gray-600">
                                        {{ \Carbon\Carbon::parse($sesion->fecha)->format('d/m/Y') }}
                                    </td>
                                    
                                    {{-- Horario --}}
                                    <td class="px-4 py-3 text-sm text-center text-gray-600 leading-tight">
                                        <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($sesion->hora_inicio)->format('H:i') }}
                                        </span>
                                        <br> a <br>
                                        <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($sesion->hora_fin)->format('H:i') }}
                                        </span>
                                    </td>
                                    
                                    {{-- Ponente --}}
                                    <td class="px-4 py-3 text-sm text-center text-gray-700 italic">
                                        {{ $sesion->ponente }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-gray-500 italic bg-gray-50">
                                    <i class="fa-solid fa-calendar-xmark text-2xl mb-2 block text-gray-300"></i>
                                    Aún no hay sesiones activas programadas para este evento.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end">
                <x-secondary-button type="button" wire:click="cerrar">
                    Cerrar ventana
                </x-secondary-button>
            </div>
        </x-slot>

    </x-dialog-modal>
</div>