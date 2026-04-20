<?php

namespace App\Livewire\Eventos;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Modulos\Eventos\Models\Evento;
use Modulos\Eventos\Models\Sesion;

class ListarSesionesComponent extends Component

{   

    public Evento $evento;

    public function mount(Evento $evento)
    {
        $this->evento = $evento;
    }
    
    #[On('actualizar-lista-sesiones')]

    public function actualizarLista()
    {

    }

    #[Computed]
    public function sesiones()
    {
        return Sesion::where('id_evento', $this->evento->id_evento)
            ->orderBy('fecha', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();
    }



    public function render()
    {
        return view('livewire.eventos.listar-sesiones-component')->layout('layouts.app');
    }
}
