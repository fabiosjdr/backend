<?php

namespace Fabio\Bibliotecas\Matematica\Calcular;

class Calcular
{
    public function executar(string $expressao): float
    {
        return eval('return ' . $expressao . ';');
    }
}
