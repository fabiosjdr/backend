<?php

namespace Fabio\Bibliotecas\Matematica\Arredondar;

class Truncar implements ArredondarTemplate
{
    public function arredondar(float $valor, int $casasDecimais): string
    {
        $power = pow(10, 2);
        if ($valor > 0) return number_format(floor($valor * $power) / $power, $casasDecimais, '.', '');
        else return number_format(ceil($valor * $power) / $power, $casasDecimais, '.', '');
    }
}