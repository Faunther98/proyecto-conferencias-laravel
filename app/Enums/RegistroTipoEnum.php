<?php

namespace App\Enums;

enum RegistroTipoEnum
{
    case Usuario;
    case Rol;
    case Evento;
    case Sesion;

    public function registroTipo()
    {
        return match ($this) {
            self::Usuario => 'usuario',
            self::Rol => 'rol',

            self::Evento => 'evento',
        };
    }

    public function descripcion()
    {
        return match ($this) {
            self::Usuario => 'Usuarios que tienen acceso al sistema.',
            self::Rol => 'Roles que se pueden asignar a los usuarios.',

            self::Evento=> 'Registro de eventos del sistema',
            self::Sesion=> 'Registro de sesiones del sistema',
        };
    }
}
