<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MUNICIPIO', function (Blueprint $table) {

            $table->id('INT_MUN');
            $table->bigInteger('INT_EST')->unsigned();
            $table->string('NM_MUN');

            $table->foreign('INT_EST')->references('INT_EST')->on('ESTADO');

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
        Schema::dropIfExists('MUNICIPIO');
    }
}
