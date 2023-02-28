<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
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
            'app_name' => 'required|min:3',
            'alamat' => 'required|min:3',
            'no_telp' => 'required|min:3',
            'email' => 'required|min:3',
            'fb' => 'required|min:3',
            'ig' => 'required|min:3',
            'wa' => 'required|min:3',
            'tw' => 'required|min:3',
            'maps' => 'required|min:3',
        ]);

        //perbaiki upload logonya
        if ($request->hasFile('logo')) {

            if ($konfigurasi->logo != '') {
                unlink($konfigurasi->logo);
            }

            $logo = $request->file('logo');
            $uuid1 = Uuid::uuid4()->toString();
            $uuid2 = Uuid::uuid4()->toString();
            $file_name = $uuid1 . $uuid2 . '.' . $logo->getClientOriginalExtension();

            $storage = 'uploads/images/';
            $logo->move($storage, $file_name);
            $data['logo'] = $storage . $file_name;
        } else {
            $data['logo'] = $konfigurasi->logo;
        }

        $konfigurasi->update($data);
        Alert::success('Sukses', 'Konfigurasi telah diperbaharui');
        return redirect('/admin/konfigurasi');
    }
}
