<?php

namespace Modulos\Inscripciones\Models;



use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modulos\Eventos\Models\Evento;

class Inscripcion extends Model
{
    use HasFactory;
    
    protected $table = 'inscripciones';
    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_usuario',
        'id_evento',
        'asistencia',

    ];

    public function evento(){
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
