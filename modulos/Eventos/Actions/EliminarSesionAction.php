<?php


namespace Modulos\Eventos\Actions;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Eventos\Models\Sesion;

class EliminarSesionAction
{
    public static function execute($idSesion)
    {
        try {

            return DB::transaction(function () use ($idSesion) {

                $sesion = Sesion::findOrFail($idSesion);

                $sesion->update([
                    'estado' => EstatusEventoEnum::Inactivo->value 
                ]);

                return $sesion; 

            }); 

        } catch(\Exception $e) {
        
            Log::error($e::class . ' > ' . $e->getFile() . ' (' . $e->getLine() . '): ' . $e->getMessage());
            throw $e;
        }
    }
}