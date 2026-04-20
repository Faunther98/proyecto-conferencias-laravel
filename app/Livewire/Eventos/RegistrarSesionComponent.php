<?php

namespace App\Livewire\Eventos;

use App\Traits\WithLiveValidation;
use App\Traits\WithTrimArreglosRecursivos;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Eventos\Actions\RegistrarSesionAction;
use Modulos\Eventos\Forms\RegistrarSesionForm;

class RegistrarSesionComponent extends Component

{

    use Toastable;
    use WithLiveValidation;
    use WithTrimArreglosRecursivos;

    public RegistrarSesionForm $form;

    public $idSesion;
    public $idEvento;
    public $modalAbierto = false;
    protected $formName = 'form';

    #[On('abrir-modal-registrar-sesion')]

    public function abrirModal($idEvento, $idSesion = null)
    {
        $this->idSesion = $idSesion;
        $this->idEvento = $idEvento;

        $this->form->reset();
        $this->resetValidation();

        if($this->idSesion){
            $this->form->setDatos($this->idSesion);
            $this->form->esEdicion = true;
        } else {
            $this->form->esEdicion = false;
            $this->form->id_evento = $this->idEvento;
        }
        $this->modalAbierto = true;
    }

    public function guardar()
    {
        $this->form = $this->trimFormRecursivos($this->form);

        try{
            $this->form->validate();

        }catch (\Exception $e){
            $this->error(__('messages.error_inesperado'));
            throw $e;
        }
        try{
            RegistrarSesionAction::execute($this->form, Auth::id(), $this->idSesion);

            $this->modalAbierto = false;
            
            $this->dispatch('actualizar-lista-sesiones');

            $mensaje = $this->form->esEdicion ? __('messages.sesion_actualizada') : __('messages.sesion_creada');
            $this->success($mensaje);
            $this->restablecer();
        }catch(\Exception $e){
            $this->error(__('messages.error_inesperado'));
        }
    }

    public function cancelar()
    {
        $this->modalAbierto=false;
        $this->restablecer();
    }

    protected function restablecer()
    {
        $this->form->reset();
        $this->idSesion = null;
        $this->resetValidation();
    }

    public function liveValidation(string $campo): void
    {
        $this->validateOnly(
            'form.' . $campo,
            $this->form->rules()
        );
    }



    public function render()
    {
        return view('livewire.eventos.registrar-sesion-component');
    }
}
