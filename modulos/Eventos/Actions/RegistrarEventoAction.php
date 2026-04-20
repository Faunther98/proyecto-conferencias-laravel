<?php

namespace Modulos\Eventos\Actions;

use App\Enums\AccionEnum;
use App\Enums\RegistroTipoEnum;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Modulos\Eventos\Forms\RegistrarEventoForm;
use Modulos\Eventos\Models\Evento;

class RegistrarEventoAction
{
    // $form  de tipo RegistrarEventoForm
    public static function execute(RegistrarEventoForm $form, $idUsuarioActual, $idEvento = null)
    {
        // transacción
        return DB::transaction(function () use ($form, $idUsuarioActual, $idEvento) {
            
            // es edición o registro para la bitácora?
            $idAccion = $idEvento ? AccionEnum::Modificacion : AccionEnum::Registro;

            if ($idEvento) {
                // se busca el evento existente
                $evento = Evento::findOrFail($idEvento);
                
                // 3. si es edición y no se cambió nada,se termina.
                if (!$form->isDirty()) {
                    return $evento; 
                }
                
                // si hubo cambios actualiza
                $evento->update([
                    'nombre' => $form->nombre,
                    'lugar' => $form->lugar,
                    'fecha_inicio' => $form->fecha_inicio,
                    'fecha_fin' => $form->fecha_fin,
                    'capacidad' => $form->capacidad,
                    'estado' => $form->estado,
                ]);

            } else {
                // si no hay $idEvento, se crea uno nuevo
                $evento = Evento::create([
                    'nombre' => $form->nombre,
                    'lugar' => $form->lugar,
                    'fecha_inicio' => $form->fecha_inicio,
                    'fecha_fin' => $form->fecha_fin,
                    'capacidad' => $form->capacidad,
                    'estado' => $form->estado,
                ]);
            }

            // se usa el query builder
            Bitacora::registrar(
                $idAccion, 
                $idUsuarioActual, 
                $evento->id_evento, 
                RegistroTipoEnum::Evento 
            );

           
            return $evento; 
        });
    }
}