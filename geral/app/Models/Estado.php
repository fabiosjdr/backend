<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'ESTADO';

    protected $primaryKey = 'INT_EST';

    protected $fillable = ['INT_EST','NM_EST','STR_SIGLA'];

    public $timestamps = true;

   
}
