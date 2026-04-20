<div>
    <x-dialog-modal wire:model="modalAbierto">

        <x-slot name="title">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 14c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ __('Confirmar cancelación de inscripción') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="text-sm text-gray-600">
                <p class="mb-2">{{ __('¿Estás seguro de que deseas cancelar tu asistencia a este evento?') }}</p>
                
                <p class="font-bold text-gray-800">
                    {{ __('Evento') }}: "{{ $nombreEvento }}"
                </p>
                
                <p class="mt-4 text-xs text-red-500 italic">
                    {{ __('Al cancelar, liberarás tu lugar y no se podrá deshacer.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end gap-2">
                <x-primary-button type="button" wire:click="eliminar" wire:loading.attr="disabled">
                    {{ __('Confirmar Cancelación') }}
                </x-primary-button>

                <x-secondary-button type="button" wire:click="cancelar" wire:loading.attr="disabled">
                    {{ __('Regresar') }}
                </x-secondary-button>
            </div>
        </x-slot>

    </x-dialog-modal>
</div>