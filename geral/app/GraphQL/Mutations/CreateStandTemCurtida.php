<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\CadastroStandTemCurtida;

final class CreateStandTemCurtida
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver  
        $INT_USU = auth()->user()->INT_USU;

        $args['INT_USU'] = $INT_USU;

        $CadastroStandTemCurtida = new CadastroStandTemCurtida();

        $CadastroStandTemCurtida->INT_USU   = $args['INT_USU'];
        $CadastroStandTemCurtida->INT_STAND = $args['INT_STAND'];

        $data = $CadastroStandTemCurtida->save();

        $CadastroStandTemCurtida->refresh();
        $args['INT_STAND_CURT'] = $CadastroStandTemCurtida->INT_STAND_CURT;

        return $args;
    }
}
