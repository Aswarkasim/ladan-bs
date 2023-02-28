<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $kecamatan_id = auth()->user()->kecamatan_id;
        $role = auth()->user()->role;
        $tahun = auth()->user()->tahun;

        $cari = request('cari');

        if ($cari) {
            if ($role == 'Kecamatan') {
                $keluarga = Keluarga::with(['kecamatan', 'desa', 'dusun'])->whereKecamatanId($kecamatan_id)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $keluarga = Keluarga::with(['kecamatan', 'desa', 'dusun'])->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
            }
        } else {
            if ($role == 'Kecamatan') {
                $keluarga = Keluarga::with(['kecamatan', 'desa', 'dusun'])->whereKecamatanId($kecamatan_id)->latest()->paginate(10);
            } else {
                $keluarga = Keluarga::with(['kecamatan', 'desa', 'dusun'])->latest()->paginate(10);
            }
        }
        $data = [
            'title'   => 'Manajemen Keluarga',
            'keluarga' => $keluarga,
            'content' => 'admin/keluarga/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dusun = Dusun::whereDesaId(auth()->user()->desa_id)->get();
        // dd($dusun);
        $data = [
            'title'   => 'Manajemen Keluarga',
            'dusun'     => $dusun,
            'content' => 'admin/keluarga/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request);
        // die;
        // dd($request);
        $data = $request->validate([
            'user_id'           => 'required',
            'desa_id'                => 'required',
            'kecamatan_id'                => 'required',
            'dusun_id'                => 'required',
            'rt_id'                => 'required',
            'no_kk'              => 'required|min:16|max:16|unique:keluargas',
        ]);


        $keluarga = Keluarga::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . $keluarga->id . '?page=penduduk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        // $no_kk = request('no_kk');
        // $keluarga =  Keluarga::with('penduduk')->whereNoKk($no_kk)->first();
        // dd($keluarga);


        $keluarga = Keluarga::find($id);
        // die($id);
        Session::put('keluarga_id', $id);
        Session::put('no_kk', $keluarga->no_kk);
        $penduduk = Penduduk::whereNoKk($keluarga->no_kk)->get();

        $s_keluarga_id = Session::get('keluarga_id');
        $data = [
            'title'   => 'Data Keluarga',
            'keluarga' => $keluarga,
            // 'penduduk' => $penduduk,
            'no_kk'    => $keluarga->no_kk,
            'content' => 'admin/keluarga/show'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $keluarga = Keluarga::find($id);
        $data = [
            'title'   => 'Edit Keluarga',
            'keluarga' => $keluarga,
            'content' => 'admin/keluarga/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $keluarga = Keluarga::find($id);
        $data = $request->validate([
            'user_id'           => 'required',
            'desa_id'           => 'required',
            'kecamatan_id'      => 'required',
            'dusun_id'          => 'required',
            'rt_id'             => 'required',
            'no_kk'             => 'required|min:16|max:16|unique:keluargas',
        ]);
        $keluarga->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . $keluarga->id . '?page=penduduk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $keluarga = Keluarga::find($id);
        $keluarga->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga');
    }
}
