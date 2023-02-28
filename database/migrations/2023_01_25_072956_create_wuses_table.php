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
        Schema::create('wuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('tanggal');
            $table->string('no_kk');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('status_pernikahan')->nullable();
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
        Schema::dropIfExists('wuses');
    }
};
