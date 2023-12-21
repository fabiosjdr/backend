<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroStandTemCurtida extends Model
{
    use HasFactory;

    protected $table = 'STAND_TEM_CURTIDA';

    protected $primaryKey = 'INT_STAND_CURT';
}
