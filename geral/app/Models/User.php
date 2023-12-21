<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
//use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'USUARIOS';

    protected $primaryKey = 'INT_USU';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NM_LGN',
        'SHA1_SENHA',
        'LG_ATV',
        'LG_SUPER',
    ];

    public function FIRST_ACCESS(): HasOne
    {


        $INT_USU = (auth()->user()) ? auth()->user()->INT_USU : 0;


        $query = DB::raw("IF(INT_LOGIN_COUNT < 2,TRUE,FALSE) as FirstAccess");

        return $this->hasOne(User::class,'INT_USU')->where('INT_USU',$INT_USU)->select($query);
        
        //$user = User::where('STR_EMAIL', $args['email'])->first();
        //return $this->hasOne(CadastroStandTemCurtida::class,'INT_USU')->where('INT_USU',9);
        //$teste =  CadastroStandTemCurtida::where('INT_USU', \auth()->user()->INT_USU)->first();
        //return DB::select(DB::raw('SELECT TRUE'));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'SHA1_SENHA',
    // ];


    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
}
