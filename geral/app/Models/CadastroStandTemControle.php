<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroStandTemControle extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_CONTROLE';

    protected $primaryKey = 'INT_STAND_CTRL';
}
