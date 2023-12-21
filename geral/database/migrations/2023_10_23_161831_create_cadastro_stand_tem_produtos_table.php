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
        Schema::create('STAND_TEM_PRODUTO', function (Blueprint $table) {
            
            $table->id('INT_STAND_PROD');

            $table->bigInteger('INT_PROD')->unsigned();
            $table->bigInteger('INT_STAND')->unsigned();

            $table->foreign('INT_STAND')->references('INT_STAND')->on('STANDS');
            $table->foreign('INT_PROD')->references('INT_PROD')->on('PRODUTOS');

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
        Schema::dropIfExists('STAND_TEM_PRODUTO');
    }
};
