<?php

namespace Fabio\Bibliotecas\Matematica\Arredondar;

interface ArredondarTemplate
{
    public function arredondar(float $valor, int $casasDecimais): string;
}