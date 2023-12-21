<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Tag(name="tipoEndereco", description="Tipo Endereço"),
 * @OA\Schema(
 *  title="TIPO ENDERECO",
 *  required={"INT_TP_END"},
 *  @OA\Property(property="INT_TP_END", type="integer", readOnly=true, example=1),
 *  @OA\Property(property="NM_TP_END", type="string", example="Fiscal")
 * )
 * 
 */
class CadastroEnderecoTipo extends Model
{
    use HasFactory;

    protected $table = 'EST_TIPO_ENDERECO';

    protected $primaryKey = 'INT_TP_END';

    protected $fillable = ['INT_TP_END','NM_TP_END'];

}

