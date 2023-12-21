<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroSegmentos extends Model
{
    use HasFactory;

    protected $table = 'SEGMENTOS';

    protected $primaryKey = 'INT_SEG';

}
