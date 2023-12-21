<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Http\Controllers\CadastroUsuarioController;
use App\Http\Requests\CadastroUsuarioRequest;
use App\Models\CadastroUsuario;

final class UpdateUsuario
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver  
        $INT_USU = auth()->user()->INT_USU;


        if($args['SHA1_SENHA']){
            $args['SHA1_SENHA'] = password_hash( $args['SHA1_SENHA'], PASSWORD_BCRYPT);
        }

        $request = new CadastroUsuarioRequest();
        $request->setValidation($args);

        $CadastroUsuarioController = new CadastroUsuarioController();
        
        $data = $CadastroUsuarioController->update($request,$INT_USU)->getData();

        return $data->data;
    }
}
