<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroProdutos extends Model
{
    use HasFactory;

    protected $table = 'PRODUTOS';

    protected $primaryKey = 'INT_PROD';
}
