<?php

namespace Modulos\Eventos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Inscripciones\Models\Inscripcion;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'capacidad',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'estado' => EstatusEventoEnum::class,
    ];


    public function sesiones(){
        return $this->hasMany(Sesion::class, 'id_evento', 'id_evento');
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class, 'id_evento', 'id_evento');
    }


}
