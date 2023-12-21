<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CadastroStandTemAvaliacao extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_AVALIACAO';

    protected $primaryKey = 'INT_STAND_AVAL';

    public function USUARIO() : BelongsTo
    {
        //return 'https://eravirtual.org/feira2023-back/';
       
         return $this->belongsTo(CadastroUsuario::class,'INT_USU');
    }

    public function AVATAR() : HasOne
    {
        //return 'https://eravirtual.org/feira2023-back/';
       
         return $this->hasOne(CadastroStandTemImagem::class,'INT_STAND');
    }
}
