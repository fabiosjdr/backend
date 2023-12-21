<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroContas extends Model
{
    use HasFactory;

    protected $table = 'CONTAS';

    protected $primaryKey = 'INT_CTA';

    protected $fillable = ['INT_CTA','LG_ATV','DH_VALID'];

    public $timestamps = true;


}
