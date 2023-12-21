<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroAreas extends Model
{
    use HasFactory;

    protected $table = 'AREAS';

    protected $primaryKey = 'INT_AREA';
}
