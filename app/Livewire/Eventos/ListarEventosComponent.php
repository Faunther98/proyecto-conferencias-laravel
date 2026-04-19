<?php

namespace App\Livewire\Eventos;

use Modulos\Eventos\Enums\EstatusEventoEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
use Livewire\Component;
use Modulos\Eventos\Models\Evento;

class ListarEventosComponent extends Component
{
    #[On('actualizar-lista-eventos')]
    public function actualizarLista()
    {
    
    }

    #[Computed]

    public function eventos ()
    {
    return Evento::where('estado', EstatusEventoEnum::Activo->value)
    ->orderBy('fecha_inicio', 'asc')
    ->get();
    }

        public function render()
    {
        return view('livewire.eventos.listar-eventos-component');
    }

}