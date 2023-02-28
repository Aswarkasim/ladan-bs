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
        Schema::create('remajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('nik');
            $table->string('no_kk');
            $table->string('tanggal');
            $table->string('nama')->nullable();
            $table->integer('umur')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->enum('kesertaan_pikr', ['YA', 'TIDAK'])->default('TIDAK');
            $table->enum('keaktifan_pikr', ['YA', 'TIDAK'])->default('TIDAK');
            $table->string('kesertaan_lainnya')->nullable();
            $table->enum('poktan_bkr', ['YA', 'TIDAK'])->default('TIDAK');
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
        Schema::dropIfExists('remajas');
    }
};
