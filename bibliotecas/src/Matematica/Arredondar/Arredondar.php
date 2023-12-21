<?php

namespace Fabio\Bibliotecas\Matematica\Arredondar;

class Arredondar implements ArredondarTemplate
{
    public function arredondar(float $valor, int $casasDecimais): string
    {
        return number_format((float) $valor, $casasDecimais, '.', '');
    }
}