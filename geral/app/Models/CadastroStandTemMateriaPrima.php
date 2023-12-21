<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroStandTemMateriaPrima extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_MATERIA_PRIMA';

    protected $primaryKey = 'INT_STAND_MAT';
}
