<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Http\Controllers\CadastroUsuarioController;
use App\Http\Requests\CadastroUsuarioRequest;

final class CreateUsuario
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver

       $request = new CadastroUsuarioRequest();
       $request->setValidation($args);

       $CadastroUsuarioController = new CadastroUsuarioController();
       
       $data = $CadastroUsuarioController->store($request)->getData();

       return $data->data;
    }
}
