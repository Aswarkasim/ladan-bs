<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Pasar;
use App\Models\Rt;
use Illuminate\Http\Request;

class AdminRegionController extends Controller
{
    //
    function getDesa($kecamatan_id)
    {
        if (!$kecamatan_id) return response()->json('NOT OK');

        $desa = Desa::where('kecamatan_id', $kecamatan_id)->get();

        if ($desa == false) return response()->json('NOT OK');

        $dataDesa = "";

        foreach ($desa as $key) {
            $dataDesa .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataDesa);
    }

    function getDusun($desa_id)
    {
        if (!$desa_id) return response()->json('NOT OK');

        $desa = Dusun::where('desa_id', $desa_id)->get();

        if ($desa == false) return response()->json('NOT OK');

        $dataPDusun = "";

        foreach ($desa as $key) {
            $dataPDusun .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataPDusun);
    }


    function getRt($dusun_id)
    {
        if (!$dusun_id) return response()->json('NOT OK');

        $dusun = Rt::where('dusun_id', $dusun_id)->get();

        if ($dusun == false) return response()->json('NOT OK');

        $dataPRt = "";

        foreach ($dusun as $key) {
            $dataPRt .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataPRt);
    }
}
