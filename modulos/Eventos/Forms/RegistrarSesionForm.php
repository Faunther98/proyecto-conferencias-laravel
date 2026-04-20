<?php

namespace Modulos\Eventos\Forms;

use App\Traits\ArreglosMultidimensionalesHelper;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Eventos\Models\Sesion;

class RegistrarSesionForm extends Form
{
    use ArreglosMultidimensionalesHelper;

    public $id_sesion;
    public $id_evento;
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $ponente;
    public $estado = EstatusEventoEnum::Activo->value;
    public $esEdicion = false;

    public function validationAttributes()
    {
        return[
            'id_evento' => 'Evento',
            'fecha' => 'Fecha de la sesión',
            'hora_inicio' => 'Hora de inicio de la sesión',
            'hora_fin' => 'Hora de termino de la sesión',
            'ponente' => 'Nombre del ponente',
            'estado' => 'Estatus de la sesión',
        ];
    }

    public function rules(): array
    {
        return[
            'id_evento' => ['required', 'integer', 'exists:eventos,id_evento'],
            'fecha' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'ponente' => ['required', 'string', 'max:255'],
            'estado' => ['required', Rule::enum(EstatusEventoEnum::class)],
        ];
    }

    public function messages()
    {
        return[
            'id_evento.required' => 'La sesión debe estar asociada a un evento',
            'id_evento.exists' => 'El evento seleccionado no es válido',
            'hora_fin.after' => 'La hora de termino debe ser posterior a la hora de inicio',
        ];
    }

    public function setDatos(?int $idSesion = null)
    {
        $this->id_sesion = $idSesion;

        $sesion = $idSesion ? Sesion::findOrFail($idSesion) : new Sesion();

        $this->esEdicion = false;

        if ($idSesion){
            $this->esEdicion = true;

            $this->id_evento =$sesion->id_evento;
            $this->fecha = $sesion->fecha;

            $this->hora_inicio = Carbon::parse($sesion->hora_inicio)->format('H:i');
            $this->hora_fin = Carbon::parse($sesion->hora_fin)->format('H:i');

            $this->ponente = $sesion->ponente;
            $this->estado = $sesion->estado;
        }
    }


    public function isDirty(): bool
    {
        if (!$this->id_sesion) {
        
            return true;
        }

        $db = Sesion::find($this->id_sesion);

        if (!$db) {
            return true;
        }

       
        $actual = $this->arrayFilterRecursive([
            'id_evento'   => $this->id_evento,
            'fecha'       => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin'    => $this->hora_fin,
            'ponente'     => $this->ponente,
            'estado'      => $this->estado,
        ], null, true);

        /
        $original = $this->arrayFilterRecursive([
            'id_evento'   => $db->id_evento,
            'fecha'       => $db->fecha,
            'hora_inicio' => Carbon::parse($db->hora_inicio)->format('H:i'), 
            'hora_fin'    => Carbon::parse($db->hora_fin)->format('H:i'),
            'ponente'     => $db->ponente,
            'estado'      => $db->estado,
        ], null, true);

       
        return !self::sonIguales($actual, $original);
    }
}
