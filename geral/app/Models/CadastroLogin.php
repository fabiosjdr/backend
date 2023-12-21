<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(name="municipio", description="Município"),
 * @OA\Schema(
 *  title="MUNICIPIO",
 *  required={"NM_MUN","INT_IBGE"},
 *  @OA\Property(property="INT_MUN", type="integer", readOnly=true, example=1),
 *  @OA\Property(property="NM_MUN", type="string", maxLength=255, example="Teste"),
 *  @OA\Property(property="INT_IBGE", type="integer", example="123456")
 * )
 * 
 */
class CadastroLogin extends Model
{
    use HasFactory;

    public static function getCliente($client)
    {
        return DB::select( DB::raw("SELECT * FROM cliente where INT_CLI = $client") );
    }

    public static function getuser($credential)
    {

        $LOGIN = $credential['STR_LOGIN'];
        $PASS  = sha1($credential['STR_PASS']);

        return DB::select( DB::raw("SELECT * FROM USUARIO WHERE NM_LGN = '$LOGIN' and SHA1_SENHA = '$PASS'") );
    }
}

