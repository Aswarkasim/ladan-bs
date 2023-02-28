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
        Schema::create('stuntings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();

            $table->string('no_kk')->nullable();
            $table->integer('tanggal')->nullable();
            $table->integer('jumlah_anggota_keluarga')->nullable();
            $table->integer('jumlah_baduta')->nullable();
            $table->integer('jumlah_balita')->nullable();


            $table->string('indikator_1')->default('TIDAK')->nullable();
            $table->string('indikator_2')->default('TIDAK')->nullable();
            $table->string('indikator_3')->default('TIDAK')->nullable();
            $table->string('indikator_4')->default('TIDAK')->nullable();
            $table->string('indikator_5')->default('TIDAK')->nullable();
            $table->string('indikator_6')->default('TIDAK')->nullable();
            $table->string('indikator_7')->default('TIDAK')->nullable();
            $table->string('indikator_8')->default('TIDAK')->nullable();
            $table->string('indikator_9')->default('TIDAK')->nullable();
            $table->string('indikator_10')->default('TIDAK')->nullable();
            $table->string('indikator_11')->default('TIDAK')->nullable();
            $table->string('indikator_12')->default('TIDAK')->nullable();
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
        Schema::dropIfExists('stuntings');
    }
};
