<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Http\Controllers\CadastroUsuarioController;
use App\Models\CadastroUsuario;

final class PasswordRecovery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        if($args['STR_EMAIL']){

            $user = CadastroUsuario::where('STR_EMAIL','=',$args['STR_EMAIL'])->first();

            if($user){

                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $newPass =  substr(str_shuffle($chars),0,8);
    
                $user->SHA1_SENHA = password_hash( $newPass, PASSWORD_BCRYPT);
    
                $user->save();
    
                $CadastroUsuario = new CadastroUsuarioController();
                $CadastroUsuario->sendEmailRecoveryPassword($user,$newPass);

                return ["MSG" => "Um email de recuperação de senha foi enviado com sucesso.","error" => ""];

            }else{

                return  ["MSG" => "" , "error" => "Não foi possível encontrar sua conta. Por favor, tente novamente." ];
            }

        }


        

    }
}
