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
        Schema::create('MATERIA_PRIMA', function (Blueprint $table) {
            $table->id('INT_MAT');
            $table->string('DESC_MAT');
            $table->string('DESC_MAT_ENG')->nullable()->default(null);
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
        Schema::dropIfExists('MATERIA_PRIMA');
    }
};
