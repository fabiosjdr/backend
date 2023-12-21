<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastroUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USUARIOS', function (Blueprint $table) {
            
            
            $table->id('INT_USU');
            $table->bigInteger('INT_EST')->unsigned();
            $table->bigInteger('INT_MUN')->unsigned();

            $table->string('SHA1_SENHA',255);
            $table->enum('LG_ATV'  ,['S','N']);
            $table->enum('LG_SUPER',['S','N']);
            $table->string('CPF_USU')->nullable()->default(null);
            $table->string('STR_EMAIL')->unique();
            $table->string('STR_TEL')->nullable()->default(null);
            $table->integer('INT_LOGIN_COUNT')->default(0);
            
            // $table->foreign('INT_EST')->references('INT_EST')->on('ESTADO')->nullable()->default(null);
            // $table->foreign('INT_MUN')->references('INT_MUN')->on('MUNICIPIO')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USUARIOS');
    }
}
