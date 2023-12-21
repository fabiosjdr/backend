<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('STANDS', function (Blueprint $table) {
            
            $table->id('INT_STAND');
            $table->integer('INT_PAG')->nullable()->default(null);
            $table->string('STR_NM')->nullable()->default(null);
            $table->string('STR_NM_FANT')->nullable()->default(null);
            $table->integer('INT_AREA')->nullable()->default(null);
            $table->integer('INT_MUN')->nullable()->default(null);
            $table->integer('INT_EST')->nullable()->default(null);
            $table->string('STR_FACE')->nullable()->default(null);
            $table->string('STR_INST')->nullable()->default(null);
            $table->string('STR_WHAT')->nullable()->default(null);
            $table->string('STR_SITE')->nullable()->default(null);
            $table->string('STR_TEL')->nullable()->default(null);
            $table->string('STR_CEL')->nullable()->default(null);
            $table->string('STR_EMAIL')->nullable()->default(null);
            $table->string('DESC_TEXT')->nullable()->default(null);
            $table->string('DESC_PROD')->nullable()->default(null);
            $table->string('STR_COTR_INT')->nullable()->default(null);
            $table->string('STR_NUM_CTRL')->nullable()->default(null);
            $table->string('STR_RUA_MAP')->nullable()->default(null);
            $table->string('STR_NIV_MAP')->nullable()->default(null);
            
            $table->enum('LG_CONF'  ,['S','N'])->default('N');
           
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
        Schema::dropIfExists('STANDS');
    }
}
