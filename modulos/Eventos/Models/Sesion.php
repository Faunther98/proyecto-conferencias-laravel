<?php

namespace Modulos\Eventos\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modulos\Eventos\Models\Evento;


class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesiones';
    protected $primaryKey = 'id_sesion';

    protected $fillable = [
        'id_evento',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'ponente',
        'estado',

    ];

    public function evento (){
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento'); 
    }
}
