<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminConfigurationController extends Controller
{
    //

    function index()
    {
        $konfigurasi  = DB::table('configurations')->where('id', '1')->first();
        $data = [
            'title'   => 'Konfigurasi',
            'konfigurasi' => $konfigurasi,
            'content' => 'admin/konfigurasi/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function update(Request $request)
    {
        $konfigurasi  = Configuration::find('1')->first();

        $data = $request->validate([
            'app_name' => 'required|min:3'
        ]);
        $konfigurasi->update($data);
        Alert::success('Sukses', 'Konfigurasi telah diperbaharui');
        return redirect('/admin/konfigurasi');
    }
}
