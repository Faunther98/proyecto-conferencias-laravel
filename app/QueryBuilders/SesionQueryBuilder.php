<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class SesionQueryBuilder extends Builder
{
    public function delEvento($idEvento): self
    {
        return $this->where('id_evento', $idEvento);
    }

    public function ordenadasCrono(): self
    {
        return $this->orderBy('fecha', 'asc')
                    ->orderBy('hora_inicio', 'asc');
    }

    public function obtenerListaPorEvento($idEvento): self
    {
        return $this->delEvento($idEvento)->ordenadasCrono();
    }
}