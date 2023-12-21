<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroStandTemGaleria extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_GALERIA';

    protected $primaryKey = 'INT_STAND_GAL';
}
