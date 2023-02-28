<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAkunController extends Controller
{
    //
    public function indexData()
    {
        //
        $kecamatan_id = auth()->user()->kecamatan_id;
        $kecamatan = Kecamatan::find($kecamatan_id);
        $data = [
            'title'   => 'Pengaturan Data',
            'kecamatan' => $kecamatan,
            'desa' => Desa::whereKecamatanId($kecamatan_id)->get(),
            'content' => 'admin/akun/data'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function simpanData(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'tahun' => 'required',
            'desa_id' => 'required',
        ]);

        $user->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect()->back();
    }
}
