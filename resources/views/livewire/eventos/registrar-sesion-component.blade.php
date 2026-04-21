<div>
    <x-dialog-modal wire:model="modalAbierto">

        <x-slot name="title">
            {{ $form->esEdicion ? 'Editar sesión' : 'Nueva sesión' }}
        </x-slot>

       
        <x-slot name="content">
            <div class="Leyenda mb-4 text-sm text-gray-600">
                Los campos marcados con <span class="text-red-500">*</span> son obligatorios.
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="flex flex-col md:col-span-2">
                    <x-input-label>
                        Nombre de la sesión <span class="text-red-500">*</span>
                    </x-input-label>
                    <input type="text" wire:model="form.nombre" wire:blur="liveValidation('nombre')" 
                
                        class="border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('form.nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
               
                <div class="flex flex-col md:col-span-2">
                    <x-input-label>
                        Nombre del ponente <span class="text-red-500">*</span>
                    </x-input-label>
                    <input type="text" wire:model="form.ponente" wire:blur="liveValidation('ponente')" 
                        class="border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('form.ponente')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Fecha --}}
                <div class="flex flex-col md:col-span-2">
                    <x-input-label>
                        Fecha de la sesión <span class="text-red-500">*</span>
                    </x-input-label>
                    <input type="date" wire:model="form.fecha" wire:blur="liveValidation('fecha')" 
                        class="border border-gray-300 p-2 rounded-md">
                    @error('form.fecha')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

               
                <div class="flex flex-col">
                    <x-input-label>
                        Hora de inicio <span class="text-red-500">*</span>
                    </x-input-label>
                    <input type="time" wire:model="form.hora_inicio" wire:blur="liveValidation('hora_inicio')" 
                        class="border border-gray-300 p-2 rounded-md">
                    @error('form.hora_inicio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="flex flex-col">
                    <x-input-label>
                        Hora de término <span class="text-red-500">*</span>
                    </x-input-label>
                    <input type="time" wire:model="form.hora_fin" wire:blur="liveValidation('hora_fin')" 
                        class="border border-gray-300 p-2 rounded-md">
                    @error('form.hora_fin')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="flex flex-col md:col-span-2">
                    <x-input-label>
                        Estatus de la sesión <span class="text-red-500">*</span>
                    </x-input-label>
                    <select wire:model="form.estado" wire:blur="liveValidation('estado')" 
                        class="border border-gray-300 p-2 rounded-md bg-white">
                        <option value="">Seleccione un estatus</option>
                        <option value="{{ \Modulos\Eventos\Enums\EstatusEventoEnum::Activo->value }}">Activa</option>
                        <option value="{{ \Modulos\Eventos\Enums\EstatusEventoEnum::Inactivo->value }}">Inactiva</option>
                    </select>
                    @error('form.estado')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-primary-button type="button" wire:click="guardar" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="guardar">
                        {{ $form->esEdicion ? 'Actualizar' : 'Guardar' }}
                    </span>
                    <span wire:loading wire:target="guardar">
                        Procesando...
                    </span>
                </x-primary-button>

                <x-secondary-button type="button" wire:click="cancelar">
                    Cancelar
                </x-secondary-button>
            </div>
        </x-slot>

    </x-dialog-modal>
</div>