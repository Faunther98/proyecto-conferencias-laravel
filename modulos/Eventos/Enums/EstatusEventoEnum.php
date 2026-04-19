<?php

namespace Modulos\Eventos\Enums;




enum EstatusEventoEnum :string
{
    case Activo = 'S';
    case Inactivo = 'N';

    public function etiqueta(): string
    {
        return match ($this) {
            self::Activo => 'Activo',
            self::Inactivo => 'Inactivo'
        };
    }

    public function color(): bool
    {
        return match ($this) {
            self::Activo => 'bg-green-100 text-green-800',
            self::Inactivo => 'bg-red-100 text-red-800'
        };
    }
}
