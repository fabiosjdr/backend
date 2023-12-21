<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroStandTemSegmento extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_SEGMENTO';

    protected $primaryKey = 'INT_STAND_PROD';
}
