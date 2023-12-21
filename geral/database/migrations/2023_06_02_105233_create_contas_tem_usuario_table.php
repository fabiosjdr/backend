<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTemUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CONTAS_TEM_USUARIO', function (Blueprint $table) {
            
            $table->id('INT_CTA_TEM_USU');
            $table->bigInteger('INT_USU')->unsigned();
            $table->bigInteger('INT_CTA')->unsigned();
            $table->enum('LG_OWNER'  ,['S','N'])->default('N');

            $table->foreign('INT_USU')->references('INT_USU')->on('USUARIOS');
            $table->foreign('INT_CTA')->references('INT_CTA')->on('CONTAS');
            
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
        Schema::dropIfExists('CONTAS_TEM_USUARIO');
    }
}
