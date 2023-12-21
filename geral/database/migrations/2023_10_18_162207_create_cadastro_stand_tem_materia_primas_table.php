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
        Schema::create('STAND_TEM_MATERIA_PRIMA', function (Blueprint $table) {
            $table->id('INT_STAND_MAT');
            $table->bigInteger('INT_MAT')->unsigned();
            $table->bigInteger('INT_STAND')->unsigned();

            $table->foreign('INT_STAND')->references('INT_STAND')->on('STANDS');
            $table->foreign('INT_MAT')->references('INT_MAT')->on('MATERIA_PRIMA');
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
        Schema::dropIfExists('STAND_TEM_MATERIA_PRIMA');
    }
};
