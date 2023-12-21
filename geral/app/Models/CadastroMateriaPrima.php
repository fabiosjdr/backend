<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroMateriaPrima extends Model
{
    use HasFactory;

    protected $table = 'MATERIA_PRIMA';

    protected $primaryKey = 'INT_MAT';
}
