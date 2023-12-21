<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class CadastroStands extends Model
{
    use HasFactory;

    protected $table = 'STANDS';

    protected $primaryKey = 'INT_STAND';

    protected $fillable = ["INT_STAND",
                            "INT_PAG",
                            "STR_NM",
                            "STR_NM_FANT",
                            "INT_AREA",
                            "INT_MUN",
                            "INT_EST",
                            "STR_FACE",
                            "STR_INST",
                            "STR_WHAT",
                            "STR_SITE",
                            "STR_TEL" ,
                            "STR_CEL",
                            "STR_EMAIL",
                            "DESC_TEXT",
                            "DESC_PROD",
                            "LG_CONF",
                            "STR_NUM_CTRL"
                        ];

    public $timestamps = true;

    public function MATERIA_PRIMA() : HasMany
    {
        return $this->hasMany(CadastroStandTemMateriaPrima::class,'INT_STAND');
    }

    public function PRODUTO() : HasMany
    {
        return $this->hasMany(CadastroStandTemProduto::class,'INT_STAND');
    }

    public function SEGMENTO() : HasMany
    {
        return $this->hasMany(CadastroStandTemSegmento::class,'INT_STAND');
    }

    public function IMAGENS() : HasMany
    {
        return $this->hasMany(CadastroStandTemImagem::class,'INT_STAND');
    }

    public function AVALIACAO() : HasMany
    {
        return $this->hasMany(CadastroStandTemAvaliacao::class,'INT_STAND');
    }

    public function GALERIA() : HasMany
    {
        return $this->hasMany(CadastroStandTemGaleria::class,'INT_STAND');
    }

    public function CURTIDA() : HasMany
    {
        return $this->hasMany(CadastroStandTemCurtida::class,'INT_STAND');
    }

    public function CONTROLE() : HasMany
    {
        return $this->hasMany(CadastroStandTemControle::class,'INT_STAND');
    }


    public function ESTADO() : BelongsTo
    {
        return $this->belongsTo(Estado::class,'INT_EST');
    }

    public function MUNICIPIO() : BelongsTo
    {
        return $this->belongsTo(Municipio::class,'INT_MUN');
    }

    public function MEDIA() : HasOne
    {

        $query = DB::raw(" ROUND(AVG(VR_AVAL),1) as Media");
        return $this->hasOne(CadastroStandTemAvaliacao::class,'INT_STAND')->select($query);
    }

    public function AREA() : BelongsTo
    {

       // $query = DB::raw(" ROUND(AVG(VR_AVAL),1) as Media");
        return $this->belongsTo(CadastroAreas::class,'INT_AREA');
        
    }


    public function STAND() : HasOne
    {

       // $query = DB::raw(" ROUND(AVG(VR_AVAL),1) as Media");
        return $this->hasOne(CadastroStands::class,'INT_STAND');
    }

    public function LIKED(): HasOne
    {


        $INT_USU = (auth()->user()) ? auth()->user()->INT_USU : 0;


        $query = DB::raw("IF(INT_USU > 0,TRUE,FALSE) as Liked");

        return $this->hasOne(CadastroStandTemCurtida::class,'INT_STAND')->where('INT_USU',$INT_USU)->select($query);
        
        //$user = User::where('STR_EMAIL', $args['email'])->first();
        //return $this->hasOne(CadastroStandTemCurtida::class,'INT_USU')->where('INT_USU',9);
        //$teste =  CadastroStandTemCurtida::where('INT_USU', \auth()->user()->INT_USU)->first();
        //return DB::select(DB::raw('SELECT TRUE'));
    }
}
