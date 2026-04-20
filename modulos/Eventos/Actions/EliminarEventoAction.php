<?php

namespace Modulos\Eventos\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Eventos\Models\Evento;

class EliminarEventoAction
{
    public static function execute($idEvento)
    {
        try {

            return DB::transaction(function () use ($idEvento) {

                $evento = Evento::findOrFail($idEvento);

                $evento->update([
                    
                    'estado' => EstatusEventoEnum::Inactivo->value 
                ]);

                
                return $evento; 

            }); 

        } catch(\Exception $e) {
            Log::error($e::class . ' > ' . $e->getFile() . ' (' . $e->getLine() . '): ' . $e->getMessage());
            throw $e;
        }
    }
}