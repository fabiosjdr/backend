<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Tag(name="endereco", description="Endereço"),
 * @OA\Schema(
 *  title="ENDERECO",
 *  required={"INT_MUN"},
 *  @OA\Property(property="INT_END", type="integer", readOnly=true, example=1),
 *  @OA\Property(property="INT_MUN", type="integer", example="1")
 * )
 * 
 */
class CadastroEndereco extends Model
{
    use HasFactory;

    protected $table = 'CADASTRO_ENDERECO';

    protected $primaryKey = 'INT_END';

    protected $fillable = ["INT_END","INT_CAD","INT_NUM","STR_LOGR","STR_BAIR","STR_CID","STR_EST","STR_PAIS","CEP_END","INT_EST","INT_MUN"];

    public $timestamps = true;

}
