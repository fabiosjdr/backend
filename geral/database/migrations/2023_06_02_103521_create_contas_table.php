<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CONTAS', function (Blueprint $table) {

            $table->id('INT_CTA');
            $table->timestamp('DH_VALID')->nullable()->default(now());
            $table->enum('LG_ATV'  ,['S','N'])->default('N');
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
        Schema::dropIfExists('CONTAS');
    }
}
