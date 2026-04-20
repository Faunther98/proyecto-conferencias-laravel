<?php

namespace App\Livewire\Eventos;

use App\Traits\WithLiveValidation;
use App\Traits\WithTrimArreglosRecursivos;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Eventos\Actions\RegistrarEventoAction;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Eventos\Forms\RegistrarEventoForm;



class RegistrarEventoComponent extends Component
{

    use Toastable;
    use WithTrimArreglosRecursivos;
    use WithLiveValidation;


    public $idEvento;
    public $modalAbierto = false;
    protected $formName = 'form';


    public RegistrarEventoForm $form;

    #[On('abrir-modal-registrar-evento')]
    public function abrirModalRegistrarEvento($idEvento = null)
    {
        $this->idEvento = $idEvento; 

        $this->form->reset();

        if($this->idEvento){
            $this->form->setDatos($this->idEvento);
            $this->form->esEdicion=true;
        } else {
            $this->form->esEdicion = false;
        }
    $this->modalAbierto=true;

    }


    public function guardar()

    {
        $this->form = $this->trimFormRecursivos($this->form, ['estado']);

        try{
            $this->form->validate();
        } catch (\Exception $e){
            $this->error(__('messages.error_inesperado'));
            throw $e;
        }
        try{
            RegistrarEventoAction::execute($this->form, Auth::id(), $this->idEvento);
            $this->modalAbierto = false;

            //para refrescar la tabla con la nueva info
            $this->dispatch('actualizar-lista-eventos');
            $mensaje = $this->form->esEdicion ? __('messages.evento_actualizado') : __('messages.evento_creado');
            //muestra el mensaje verde
            $this->success($mensaje);
            // se limpia
            $this->restablecer(); 
        } catch (\Exception $e){
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
        $this->idEvento = null;
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
        return view('livewire.eventos.registrar-evento-component', [
            'estatusEnum' => EstatusEventoEnum::class
        ]);
    }
}
