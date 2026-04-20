<?php

namespace App\Livewire\Eventos;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Eventos\Actions\EliminarEventoAction;

class EliminarEventoComponent extends Component
{

    use Toastable;

    public $idEvento;
    public $nombreEvento;
    public $modalAbierto = false;


    public function render()
    {
        return view('livewire.eventos.eliminar-evento-component');
    }

    #[On('abrir-modal-eliminar-evento')]
    public function abrirModal($idEvento, $nombreEvento)
    {
        $this->idEvento = $idEvento;
        $this->nombreEvento = $nombreEvento;
        $this->modalAbierto = true;
    }

    public function cancelar()
    {
        $this->modalAbierto=false;
    }
    public function eliminar()
    {
        try{
            EliminarEventoAction::execute($this->idEvento);
            $this->modalAbierto = false;
            $this->dispatch('actualizar-lista-eventos');
            $this->success(__('messages.evento_eliminado'));
        }catch(\Exception $e){
            $this->error(__('messages.error_inesperado'));
        }
    }
}
