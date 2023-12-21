<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Tag(name="pessoa", description="Pessoa"),
 * @OA\Schema(
 *  title="PESSOA",
 *  required={"NM_PES"},
 *  @OA\Property(property="INT_PES", type="integer", readOnly=true, example=1),
 *  @OA\Property(property="NM_PES", type="string", maxLength=255, example="Teste"),
 * )
 * 
 */
class CadastroPermissoes extends Model
{
    use HasFactory;

    protected $table = 'GE_USUARIO_TEM_PERMISSAO';

    protected $primaryKey = 'INT_USU_PERM';

    protected $fillable = ['ID_MENU','INT_PES'];
}
