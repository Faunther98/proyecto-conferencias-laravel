<?php

namespace Modulos\Inscripciones\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Modulos\Eventos\Models\Evento;
use Modulos\Inscripciones\Models\Inscripcion;

class RegistrarInscripcionAction
{
    public static function execute($idEvento, $idUsuario)
    {
        return DB::transaction(function () use($idEvento, $idUsuario) {

            $evento = Evento::findOrFail($idEvento);
            $inscritosActuales = Inscripcion::where('id_evento', $idEvento)->count();

            if($inscritosActuales >= $evento->capacidad){
                throw new \Exception('Lo sentimos, pero este evento ya no tiene cupo disponible');
            }

            $yaInscrito = Inscripcion::where('id_evento', $idEvento)->where('id_usuario', $idUsuario)->exists();

            if($yaInscrito){
                throw new \Exception('Ya te encuentras inscrito en este evento');
            }

            $inscripcion = Inscripcion::create([
                'id_evento' => $idEvento,
                'id_usuario' => $idUsuario,

                // aqui debería ir la asistencia? investigar
            ]);

                // Bitacora si la implemento Bitacora::registrar...
                return $inscripcion;
        });
    } 
}