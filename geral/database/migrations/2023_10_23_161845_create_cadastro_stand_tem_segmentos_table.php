<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('STAND_TEM_SEGMENTO', function (Blueprint $table) {
            
            $table->id('INT_STAND_SEG');

            $table->bigInteger('INT_SEG')->unsigned();
            $table->bigInteger('INT_STAND')->unsigned();

            $table->foreign('INT_STAND')->references('INT_STAND')->on('STANDS');
            $table->foreign('INT_SEG')->references('INT_SEG')->on('SEGMENTOS');

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
        Schema::dropIfExists('STAND_TEM_SEGMENTO');
    }
};
