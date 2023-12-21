<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'MUNICIPIO';

    protected $primaryKey = 'INT_MUN';

    protected $fillable = ['INT_MUN','INT_EST','NM_MUN'];

    public function ESTADO(): BelongsTo
    {
        return $this->belongsTo(Estado::class,'INT_EST');
    }


}
