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
        Schema::create('STAND_TEM_IMAGEM', function (Blueprint $table) {
            $table->id('INT_STAND_IMG');
            $table->bigInteger('INT_STAND')->unsigned();
            $table->longtext('STR_URL');
            $table->string('STR_TP')->nullable()->default(null);
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
        Schema::dropIfExists('STAND_TEM_IMAGEM');
    }
};
