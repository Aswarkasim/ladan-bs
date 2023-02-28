<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');
        $kecamatan_id = request('kecamatan_id');

        if ($cari) {
            $desa = Desa::with('kecamatan')->whereKecamatanId($kecamatan_id)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $desa = Desa::with('kecamatan')->whereKecamatanId($kecamatan_id)->latest()->paginate(10);
        }

        $kecamatan = Kecamatan::find($kecamatan_id);
        $data = [
            'title'   => 'Manajemen Desa, Kecamatan ' . $kecamatan->name,
            'desa' => $desa,
            'content' => 'admin/desa/index'
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
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);
        $data = [
            'title'   => 'Manajemen Desa, Kecamatan ' . $kecamatan->name,
            'kecamatan' => Kecamatan::all(),
            'content' => 'admin/desa/add'
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
            'name'              => 'required|min:3',
            'kecamatan_id'              => 'required',
        ]);
        Desa::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/wilayah/desa?kecamatan_id=' . $data['kecamatan_id']);
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
        $desa = Desa::find($id);
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);
        $data = [
            'title'   => 'Manajemen Desa, Kecamatan ' . $kecamatan->name,
            'desa' => $desa,
            'content' => 'admin/desa/add'
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
        $desa = Desa::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'kecamatan_id'              => 'required',
        ]);
        $desa->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/wilayah/desa?kecamatan_id=' . $data['kecamatan_id']);
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
        $desa = Desa::find($id);
        $desa->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/wilayah/desa?kecamatan_id=' . $desa->kecamatan_id);
    }
}
