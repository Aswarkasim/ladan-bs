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
        Schema::create('indikatorstuntingpilihs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('stuntings_id ');
            $table->foreignId('indikatortunting_id');
            $table->string('no_kk');
            $table->text('indikator')->nullable();
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
        Schema::dropIfExists('indikatorstuntingpilihs');
    }
};
