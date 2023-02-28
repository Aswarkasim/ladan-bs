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
        Schema::create('datapenduduks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('tanggal');
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->enum('memiliki_akta_kelahiran', ['YA', 'TIDAK'])->nullable();
            $table->enum('status_perkawinan', ['Menikah', 'Janda', 'Duda', 'Belum Menikah'])->default('Belum Menikah');
            $table->enum('pbi', ['YA', 'Tidak'])->default('Tidak');
            $table->enum('non_pbi', ['YA', 'Tidak'])->default('Tidak');
            $table->enum('bpjs', ['YA', 'Tidak'])->default('Tidak');
            $table->string('asuransi_swasta')->nullable();
            $table->enum('kepemilikan_ktp', ['YA', 'Tidak'])->default('Tidak');
            $table->enum('kepemilikan_akta_kelahiran', ['YA', 'Tidak'])->default('Tidak');
            $table->string('status_dalam_kk')->nullable();
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
        Schema::dropIfExists('datapenduduks');
    }
};
