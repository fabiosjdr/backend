<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroTipoVisitante extends Model
{
    use HasFactory;

    protected $table = 'TIPO_VISITANTE';

    protected $primaryKey = 'INT_TP_VS';

}
