<?php

namespace Modulos\Eventos\Forms;

use App\Traits\ArreglosMultidimensionalesHelper;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Modulos\Eventos\Enums\EstatusEventoEnum;
use Modulos\Eventos\Models\Evento;

class RegistrarEventoForm extends Form

{

    use ArreglosMultidimensionalesHelper;

    public $id_evento;
    public $nombre;
    public $lugar;
    public $fecha_inicio;
    public $fecha_fin;
    public $capacidad;
    public $estado = EstatusEventoEnum::Activo->value;
    public $esEdicion = false;

    public function validationAttributes()

    {
        return[
            'nombre' => 'Nombre del evento',
            'lugar' =>  'Lugar o sede',
            'fecha_inicio' => 'Fecha de inicio',
            'capacidad' => 'Capacidad de asistentes',
            'estado' => 'Estatus del evento',
        ];
        
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'min:5', 'max:255'],

            'lugar' => ['required', 'max:255'],
            
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
    
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            
            'capacidad' => ['required', 'numeric', 'integer', 'min:1', 'max:10000'],
            
            'estado' => ['required', Rule::enum(EstatusEventoEnum::class)],
        ];
    }

    public function messages()
    {
        return [
            "fecha_inicio.after_or_equal" => "La fecha de inicio no puede ser anterior al día de hoy.",
            "fecha_fin.after_or_equal" => "La fecha de fin no puede ser antes que la fecha de inicio.",
            "capacidad.max" => "La capacidad máxima permitida es de :max asistentes.",

            "capacidad.min" => "El evento debe tener cupo para al menos :min persona.",

            "capacidad.numeric" => "La capacidad debe ser un número válido (ej. 50).",


        ];
        
    }

    public function setDatos(?int $idEvento = null)
    {
        $this->id_evento = $idEvento;

        $evento = $idEvento ? Evento::findOrFail($idEvento) : new Evento();
        
        $this->esEdicion = false;

    
        if ($idEvento) {

            $this->esEdicion = true;
            
            $this->nombre = $evento->nombre;
            $this->lugar = $evento->lugar;
            $this->fecha_inicio = $evento->fecha_inicio;
            $this->fecha_fin = $evento->fecha_fin;
            $this->capacidad = $evento->capacidad;
            $this->estado = $evento->estado;
        }
    }

    public function isDirty(): bool
    {
        if (!$this->id_evento) {
            // Si es nuevo, por naturaleza "está sucio" (hay que insertarlo sí o sí).
            return true;
        }

        // Traemos la versión original y fresca de la base de datos
        $db = Evento::find($this->id_evento);

        // Seguridad: Si por alguna razón extraña no existe, dejamos que pase
        if (!$db) {
            return true;
        }

        // Usamos arrayFilterRecursive para limpiar espacios en blanco extraños o nulos

        $actual = $this->arrayFilterRecursive([
            'nombre' => $this->nombre,
            'lugar' => $this->lugar,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'capacidad' => $this->capacidad,
            'estado' => $this->estado,
        ], null, true);

        // Preparamos lo que tiene Postgres guardado
        $original = $this->arrayFilterRecursive([
            'nombre' => $db->nombre,
            'lugar' => $db->lugar,
            'fecha_inicio' => $db->fecha_inicio,
            'fecha_fin' => $db->fecha_fin,
            'capacidad' => $db->capacidad,
            'estado' => $db->estado,
        ], null, true);

        return !self::sonIguales($actual, $original);
    }

}