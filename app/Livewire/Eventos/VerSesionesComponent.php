<?php

namespace App\Livewire\Eventos;

use Livewire\Attributes\On;
use Livewire\Component;
use Modulos\Eventos\Models\Evento;

class VerSesionesComponent extends Component
{
    public $idEvento;
    public $modalAbierto = false;
    public $eventoSeleccionado = null;

    #[On('abrir-modal-ver-sesiones')]
    public function abrirModal($idEvento)
    {
        $this->idEvento = $idEvento;
        

        $this->eventoSeleccionado = Evento::with(['sesiones'])->find($idEvento);
        
        $this->modalAbierto = true;
    }

    public function cerrar()
    {
        $this->modalAbierto = false;
        $this->restablecer();
    }

    protected function restablecer()
    {
        $this->idEvento = null;
        $this->eventoSeleccionado = null;
    }

    public function render()
    {
        return view('livewire.eventos.ver-sesiones-component');
    }
}