<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CadastroStandTemProduto extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_PRODUTO';

    protected $primaryKey = 'INT_STAND_PROD';

    public function PRODUTO(): BelongsTo
    {
        return $this->belongsTo(CadastroProdutos::class,'INT_PROD');
    }
    
}
