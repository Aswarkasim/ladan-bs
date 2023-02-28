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
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('no_kk');
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('tanggal');
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->enum('klasifikasi', ['Bayi', 'Baduta', 'Balita'])->nullable();
            $table->enum('kesertaan_posyandu', ['YA', 'TIDAK'])->default('TIDAK');
            $table->enum('poktan_bkb', ['YA', 'TIDAK'])->default('TIDAK');
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
        Schema::dropIfExists('balitas');
    }
};
