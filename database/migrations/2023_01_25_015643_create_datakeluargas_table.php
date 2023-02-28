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
        Schema::create('datakeluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('tanggal');
            $table->string('no_kk');
            $table->integer('jumlah_balita')->default(0);
            $table->integer('jumlah_remaja')->default(0);
            $table->integer('jumlah_lansia')->default(0);
            $table->enum('poktan_bkb', ['YA', 'TIDAK'])->default('TIDAK');
            $table->enum('poktan_bkr', ['YA', 'TIDAK'])->default('TIDAK');
            $table->enum('poktan_bkl', ['YA', 'TIDAK'])->default('TIDAK');
            $table->string('sumber_air_minum')->nullable();
            $table->string('bahan_bakar_memasak')->nullable();
            $table->string('kepemilikan_rumah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('kesetaraan_sosial')->nullable();
            $table->string('tahapan_ks')->nullable();
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
        Schema::dropIfExists('datakeluargas');
    }
};
