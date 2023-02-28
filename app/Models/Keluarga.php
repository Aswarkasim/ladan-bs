<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $guarded = [];

    function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'no_kk');
    }

    function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
}
