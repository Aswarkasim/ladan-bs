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
        Schema::create('ibuhamils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('no_kk')->nullable();
            $table->string('nik_istri')->nullable();
            $table->string('nama_istri')->nullable();
            $table->string('nik_suami')->nullable();
            $table->string('nama_suami')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('dusun_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('tanggal');
            $table->integer('kehamilan_keberapa')->nullable();
            $table->date('tanggal_mulai_hamil')->nullable();
            $table->date('perkiraan_melahirkan')->nullable();
            $table->date('tanggal_kelahiran')->nullable();
            $table->string('status')->nullable();
            $table->string('jenis_kehamilan')->nullable();
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
        Schema::dropIfExists('ibuhamils');
    }
};
