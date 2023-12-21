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
        Schema::create('STAND_TEM_CONTROLE', function (Blueprint $table) {
            
            $table->id('INT_STAND_CTRL');
            $table->bigInteger('INT_STAND')->unsigned();
            $table->string('STR_COTR_INT');

            $table->foreign('INT_STAND')->references('INT_STAND')->on('STANDS')->onDelete('cascade');

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
        Schema::dropIfExists('cadastro_stand_tem_controles');
    }
};
