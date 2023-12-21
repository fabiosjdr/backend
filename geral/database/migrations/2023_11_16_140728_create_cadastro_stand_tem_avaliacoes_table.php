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
        Schema::create('STAND_TEM_AVALIACAO', function (Blueprint $table) {
            
            $table->id('INT_STAND_AVAL');
            $table->bigInteger('INT_STAND')->unsigned();
            $table->bigInteger('INT_USU')->unsigned();
            $table->text('DESC_AVAL');
            $table->float('VR_AVAL');

            $table->foreign('INT_USU')->references('INT_USU')->on('USUARIOS');
            $table->foreign('INT_STAND')->references('INT_STAND')->on('STANDS');

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
        Schema::dropIfExists('STAND_TEM_AVALIACAO');
    }
};
