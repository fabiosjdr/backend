<?php

namespace Fabio\Bibliotecas\Util;

/**
 * Classe Facade
 * 
 * Ao ser extendida, possibilita utilização
 *  da classe de forma estática ou instanciada.
 */
class Facade
{
    public function __call($name, $arguments)
    {
        $method = 'set' . ucfirst($name);

        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new static;

        $method = 'set' . ucfirst($name);

        if (method_exists($instance, $method)) {
            return call_user_func_array([$instance, $method], $arguments);
        }
    }
}
