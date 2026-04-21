<?php

namespace App\Livewire\Publico;

use Modulos\Eventos\Enums\EstatusEventoEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination; 
use Masmerise\Toaster\Toastable;
use Modulos\Eventos\Models\Evento;
use Modulos\Inscripciones\Actions\RegistrarInscripcionAction;

class CarteleraEventosComponent extends Component
{   
    use Toastable;
    use WithPagination; 


    public function inscribirse($idEvento)
    {
        if(!Auth::check()){
            $this->error(__('messages.error_iniciar_sesion'));
            return redirect()->route('login');
        } 

        try {
            RegistrarInscripcionAction::execute($idEvento, Auth::id());
            $this->success(__('messages.inscripcion_exitosa'));
        } catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }

    public function render()
    {
        
        $eventos = Evento::where('estado', EstatusEventoEnum::Activo->value)
                         ->paginate(6);

        return view('livewire.publico.cartelera-eventos-component', [
            'eventos' => $eventos
        ]);
    }
}