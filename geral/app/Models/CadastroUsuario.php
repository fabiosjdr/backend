<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CadastroUsuario extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'USUARIOS';

    protected $primaryKey = 'INT_USU';

    protected $fillable = ['INT_USU','SHA1_SENHA','STR_NM_USU','LG_ATV','LG_SUPER','CPF_USU','STR_EMAIL','INT_EST','INT_MUN','STR_TEL'];

    public $timestamps = true;


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword(){
        return $this->SHA1_SENHA;
    }


}
