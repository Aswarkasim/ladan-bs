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
        Schema::create('puses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('tanggal');
            $table->string('no_kk');
            $table->string('nik_istri');
            $table->string('nama_istri');
            $table->string('nik_suami');
            $table->string('nama_suami');
            $table->string('kelompok_umur')->nullable();
            $table->string('kesertaan_berkb')->nullable();
            $table->string('jika_tidak_berkb')->nullable();
            $table->string('jalur')->nullable();
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
        Schema::dropIfExists('puses');
    }
};
