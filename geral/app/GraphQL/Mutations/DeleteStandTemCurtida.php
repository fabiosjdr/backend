<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\CadastroStandTemCurtida;

final class DeleteStandTemCurtida
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver  
        $INT_USU = auth()->user()->INT_USU;

        $data = CadastroStandTemCurtida::where('INT_STAND','=',$args['INT_STAND'])->where('INT_USU','=',$INT_USU)->get();

        $out['INT_STAND'] = $args['INT_STAND']; //(array) response()->json($data, 200)->getData()[0];

        $out['success']   = CadastroStandTemCurtida::where('INT_STAND','=',$args['INT_STAND'])->where('INT_USU','=',$INT_USU)->delete();

        return $out;

    }
}
