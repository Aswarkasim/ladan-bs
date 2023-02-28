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
        Schema::create('lansias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('nama');
            $table->string('tanggal');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->enum('poktan_bkl', ['YA', 'TIDAK'])->default('TIDAK');
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
        Schema::dropIfExists('lansias');
    }
};
