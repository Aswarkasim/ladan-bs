<?php

namespace App\Http\Controllers;

use App\Enums\PeranKeluarga;
use App\Models\Penduduk;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = [
            'title'   => 'Manajemen Penduduk',
            // 'penduduk' => $penduduk,
            'content' => 'admin/penduduk/index'
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

        $no_kk = Session::get('no_kk');
        // $keluarga_id = Session::get('keluarga_id');
        // die($keluarga_id);
        $data = [
            'title'   => 'Manajemen Penduduk',
            'no_kk'     => $no_kk,
            'content' => 'admin/penduduk/add'
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
        // $no_kk = Session::get('no_kk');
        $data = $request->validate([
            'no_kk'         => 'required|min:16|max:16',
            'nik'         => 'required|min:16|max:16|unique:penduduks',
            'nama'          => 'required',
            'jenis_kelamin'          => 'required',
            'tempat_lahir'          => 'required',
            'tanggal_lahir'          => 'required',
            'agama'          => 'required',
            'peran'         => 'required'
        ]);
        $data['user_id']    = auth()->user()->id;
        $no_kk = getTheSession('no_kk');
        $keluarga = Keluarga::whereNoKk($no_kk)->first();
        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;

        Penduduk::create($data);


        toast('Data Sukses ditambahkan', 'success');
        $keluarga_id = Session::get('keluarga_id');
        return redirect('/admin/dp/keluarga/' . $keluarga_id . '?page=penduduk');
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

        $no_kk = request('no_kk');
        $data = [
            'title'   => 'Data Penduduk',
            'penduduk' => Penduduk::with('penduduk')->whereNoKk($no_kk)->first(),
            'content' => 'admin/penduduk/show'
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
        $penduduk = Penduduk::find($id);
        $data = [
            'title'   => 'Edit Penduduk',
            'penduduk' => $penduduk,
            'content' => 'admin/penduduk/add'
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
        $penduduk = Penduduk::find($id);
        $data = $request->validate([
            'no_kk'         => 'required|min:16|max:16',
            'nik'           => 'required|min:16|max:16|unique:penduduks,nik,' . $penduduk->id,
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'agama'         => 'required',
            'peran'         => 'required'
        ]);
        $data['user_id']    = auth()->user()->id;
        $keluarga = Keluarga::whereNoKk($request->no_kk)->first();

        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;


        $penduduk->update($data);

        toast('Data Sukses diubah', 'success');
        $keluarga_id = Session::get('keluarga_id');
        return redirect('/admin/dp/keluarga/' . $keluarga_id . '?page=penduduk');
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
        $penduduk = Penduduk::find($id);
        $penduduk->delete();
        toast('Data Sukses dihapus', 'success');
        $keluarga_id = Session::get('keluarga_id');
        return redirect('/admin/dp/keluarga/' . $keluarga_id . '?page=penduduk');
    }
}
