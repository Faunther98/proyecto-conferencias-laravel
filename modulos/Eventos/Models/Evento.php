<?php

namespace Modulos\Eventos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modulos\Inscripciones\Models\Inscripcion;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'id_eventos';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'capacidad',
        'estado'
    ];


    public function sesiones(){
        return $this->hasMany(Sesion::class, 'id_evento', 'id_evento');
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class, 'id_evento', 'id_evento');
    }


}
