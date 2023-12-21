<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaTemUsuario extends Model
{
    use HasFactory;

    protected $table = 'CONTAS_TEM_USUARIO';

    protected $primaryKey = 'INT_CTA_TEM_USU';

    protected $fillable = ['INT_CTA_TEM_USU','INT_CTA','INT_USU','LG_OWNER'];

    public $timestamps = true;
}
