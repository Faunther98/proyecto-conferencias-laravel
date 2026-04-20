<?php

namespace App\Livewire\Inscripciones;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Inscripciones\Actions\CancelarInscripcionAction;

class CancelarInscripcionComponent extends Component
{
    use Toastable;

    public $idInscripcion;
    public $nombreEvento;
    public $modalAbierto = false;

    #[On('abrir-modal-cancelar-inscripcion')]
    public function abrirModal($idInscripcion, $nombreEvento = '')
    {
        $this->idInscripcion = $idInscripcion;
        $this->nombreEvento = $nombreEvento;
        $this->modalAbierto = true;
    }

    public function cancelar()
    {
        $this->modalAbierto = false;
    }

    public function eliminar()
    {
        try {
          
            CancelarInscripcionAction::execute($this->idInscripcion);

            $this->modalAbierto = false;
        
            $this->dispatch('actualizar-lista-inscripciones');

            $this->success(__('messages.inscripcion_cancelada'));

        } catch (\Exception $e) {
            $this->error(__('messages.error_inesperado'));
        }
    }

    public function render()
    {
        return view('livewire.inscripciones.cancelar-inscripcion-component');
    }
}