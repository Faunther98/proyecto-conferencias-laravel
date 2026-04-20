<?php

namespace App\Livewire\Inscripciones;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Modulos\Inscripciones\Models\Inscripcion;

class ListarInscripcionesUsuarioComponent extends Component
{

    #[On('actualizar-lista-inscripciones')]
    public function actualizarLista()
    {
    }

    #[Computed]
    public function inscripciones()
    {
        return Inscripcion::with('evento')
            ->where('id_usuario', Auth::id())
            ->get();
    }

    public function render()
    {
        return view('livewire.inscripciones.listar-inscripciones-usuario-component');
    }
}