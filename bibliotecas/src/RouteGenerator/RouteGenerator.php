<?php

namespace Fabio\Bibliotecas\RouteGenerator;

class RouteGenerator
{
    public static function gerarRota($route, string $controller, string $model, string $primaryKey,string $module,string $suffix = '')
    {
        return $route::controller($controller)->group(function() use ($route, $model, $primaryKey,$module,$suffix) {
            $route::get('/'.$module.'/' . $model . '/', 'index'.$suffix);
            $route::post('/'.$module.'/' . $model . '/', 'store'.$suffix);
            $route::get('/'.$module.'/' . $model . '/{'  . $primaryKey . '}', 'show'.$suffix);
            $route::put('/'.$module.'/' . $model . '/{'  . $primaryKey . '}', 'update'.$suffix);
            $route::delete('/'.$module.'/' . $model . '/{' . $primaryKey . '}', 'destroy'.$suffix);
        });
    }
}