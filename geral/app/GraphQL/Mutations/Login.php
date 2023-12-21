<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Http\Controllers\AuthController;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $auth =  new AuthController();
        $login = (array) $auth->login($args)->getData();

        // $json['access_token'] = '123';
        // $json['token_type']   = 'Bearer';
        // $json['expires_in']   = "3600";

        return $login;
    }
}
