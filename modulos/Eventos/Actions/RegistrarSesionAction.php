<?php

namespace Modulos\Eventos\Actions;

use App\Enums\AccionEnum;
use App\Enums\RegistroTipoEnum;
use App\Models\Bitacora;
use Modulos\Eventos\Models\Sesion;
use Illuminate\Support\Facades\DB;
use Modulos\Eventos\Forms\RegistrarSesionForm;

class RegistrarSesionAction
{
    public static function execute(RegistrarSesionForm $form, $idUsuarioActual, $idSesion = null)
    {
        return DB::transaction(function () use ($form, $idUsuarioActual,$idSesion) {

            $idAccion = $idSesion ? AccionEnum::Modificacion : AccionEnum::Registro;

            if ($idSesion){
                $sesion =Sesion::findOrFail($idSesion);

                if (!$form->isDirty()){
                    return $sesion;
                }
                // si hubo cambios se actualiza
                $sesion->update([
                    'id_evento'   => $form->id_evento,
                    'fecha'       => $form->fecha,
                    'hora_inicio' => $form->hora_inicio,
                    'hora_fin'    => $form->hora_fin,
                    'ponente'     => $form->ponente,
                    'estado'      => $form->estado,
                ]);
            } else {
                // si no hay $idSesion, se crea una nueva
                $sesion = Sesion::create([
                    'id_evento'   => $form->id_evento,
                    'fecha'       => $form->fecha,
                    'hora_inicio' => $form->hora_inicio,
                    'hora_fin'    => $form->hora_fin,
                    'ponente'     => $form->ponente,
                    'estado'      => $form->estado,
                ]);
            }

            Bitacora::registrar(
                $idAccion, 
                $idUsuarioActual, 
                $sesion->id_sesion, 
                RegistroTipoEnum::Sesion 
            );
           
            return $sesion;
            
        });
    }
}
