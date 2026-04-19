<?php

namespace Modulos\Eventos\Actions;
use Modulos\Eventos\Forms\RegistrarEventoForm;
use Modulos\Eventos\Models\Evento;

class RegistrarEventoAction
{

    public static function execute(RegistrarEventoForm $form, $idUsuarioActual, $idEvento = null)
    {
     
        if ($idEvento) {
        
            $evento = Evento::findOrFail($idEvento);
            
            if (!$form->isDirty()) {
                return $evento; 
            }
        } else {
        
            $evento = new Evento();
        }

        $evento->nombre = $form->nombre;
        $evento->lugar = $form->lugar;
        $evento->fecha_inicio = $form->fecha_inicio;
        $evento->fecha_fin = $form->fecha_fin;
        $evento->capacidad = $form->capacidad;
        $evento->estado = $form->estado;

        $evento->save();

        // Pendiente egistrar aquí quién hizo el cambio en una bitácora.

        return $evento; 
    }
}