<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
class CadastroStandTemImagem extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_IMAGEM';

    protected $primaryKey = 'INT_STAND_IMG';

    public function DOMAIN() : HasOne
    {
        //return 'https://eravirtual.org/feira2023-back/';
         $query = DB::raw("  \"https://eravirtual.org/feira2023-back/\" as Domain");
         return $this->hasOne(CadastroStandTemImagem::class,'INT_STAND_IMG')->select($query);
    }
}

