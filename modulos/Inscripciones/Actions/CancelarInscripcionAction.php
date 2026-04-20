<?php

namespace Modulos\Inscripciones\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modulos\Inscripciones\Models\Inscripcion;

class CancelarInscripcionAction
{
    public static function execute($idInscripcion)
    {
        try {
           
            return DB::transaction(function () use ($idInscripcion) {

                $inscripcion = Inscripcion::findOrFail($idInscripcion);

                $inscripcion->delete();

                return true;
            });

        } catch (\Exception $e) {
            
            Log::error($e::class . ' > ' . $e->getFile() . ' (' . $e->getLine() . '): ' . $e->getMessage());
            
            throw $e;
        }
    }
}