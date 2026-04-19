<div>
<x-dialog-modal wire:model="modalAbierto">

    <x-slot name="title">
        {{ $form->esEdicion ? 'Editar evento' : 'Nuevo evento' }}
    </x-slot>

    <x-slot name="content">
        <div class="Leyenda mb-4 text-sm text-gray-600">
            Los campos marcados con <span class="text-red-500">*</span> son obligatorios.
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            {{-- Nombre del Evento --}}
            <div class="flex flex-col md:col-span-2">
                <x-input-label>
                    Nombre del evento <span class="text-red-500">*</span>
                </x-input-label>
                <input type="text" wire:model="form.nombre" wire:blur="liveValidation('nombre')" 
                    class="border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('form.nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Lugar / Sede --}}
            <div class="flex flex-col">
                <x-input-label>
                    Lugar o Sede <span class="text-red-500">*</span>
                </x-input-label>
                <input type="text" wire:model="form.lugar" wire:blur="liveValidation('lugar')" 
                    class="border border-gray-300 p-2 rounded-md">
                @error('form.lugar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Capacidad --}}
            <div class="flex flex-col">
                <x-input-label>
                    Capacidad de asistentes <span class="text-red-500">*</span>
                </x-input-label>
                <input type="number" wire:model="form.capacidad" wire:blur="liveValidation('capacidad')" min="1" max="10000" x-on:input="if($el.value > 10000) $el.value = 10000" step="1" onkeypress="return event.charCode >=48" 
                    class="border border-gray-300 p-2 rounded-md">
                @error('form.capacidad')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha de Inicio --}}
            <div class="flex flex-col">
                <x-input-label>
                    Fecha de inicio <span class="text-red-500">*</span>
                </x-input-label>
                <input type="date" wire:model="form.fecha_inicio" wire:blur="liveValidation('fecha_inicio')" 
                    class="border border-gray-300 p-2 rounded-md">
                @error('form.fecha_inicio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha de Fin --}}
            <div class="flex flex-col">
                <x-input-label>
                    Fecha de término <span class="text-red-500">*</span>
                </x-input-label>
                <input type="date" wire:model="form.fecha_fin" wire:blur="liveValidation('fecha_fin')" 
                    class="border border-gray-300 p-2 rounded-md">
                @error('form.fecha_fin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Estatus / Estado --}}
            <div class="flex flex-col md:col-span-2">
                <x-input-label>
                    Estatus del evento <span class="text-red-500">*</span>
                </x-input-label>
                <select wire:model="form.estado" wire:blur="liveValidation('estado')" 
                    class="border border-gray-300 p-2 rounded-md bg-white">
                    <option value="">Seleccione un estatus</option>
                    <option value="{{ \Modulos\Eventos\Enums\EstatusEventoEnum::Activo->value }}">Activo</option>
                    <option value="{{ \Modulos\Eventos\Enums\EstatusEventoEnum::Inactivo->value }}">Inactivo</option>
                </select>
                @error('form.estado')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <x-primary-button type="button" wire:click="guardar">
                {{ $form->esEdicion ? 'Actualizar' : 'Guardar' }}
            </x-primary-button>

            <x-secondary-button type="button" wire:click="cancelar">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>

</x-dialog-modal>
</div>