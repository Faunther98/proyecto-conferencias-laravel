<?php

namespace App\Livewire\Eventos;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Eventos\Actions\EliminarSesionAction;

class EliminarSesionComponent extends Component
{
    use Toastable;

    public $idSesion;
    public $nombreSesion;
    public $modalAbierto = false;



    #[On('abrir-modal-eliminar-sesion')]
    public function abrirModal($idSesion, $nombreSesion = '')
    {
        $this->idSesion = $idSesion;
        $this->nombreSesion = $nombreSesion;
        $this->modalAbierto = true;
    }

    public function cancelar()
    {
        $this->modalAbierto = false;
    }

    public function eliminar()
    {
        try {
            
            EliminarSesionAction::execute($this->idSesion);

            $this->modalAbierto = false;

        
            $this->dispatch('actualizar-lista-sesiones');

            $this->success(__('messages.sesion_eliminada'));

        } catch (\Exception $e) {
            $this->error(__('messages.error_inesperado'));
        }
    }

    public function render()
    {
        return view('livewire.eventos.eliminar-sesion-component');
    }
}