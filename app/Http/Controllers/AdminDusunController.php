<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDusunController extends Controller
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
        $desa_id = request('desa_id');


        if ($cari) {
            $dusun = Dusun::whereDesaId($desa_id)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $dusun = Dusun::whereDesaId($desa_id)->latest()->paginate(10);
        }

        $desa = Desa::find($desa_id);
        // dd($desa);
        $data = [
            'title'   => 'Manajemen Dusun, Desa ' . $desa->name,
            'dusun' => $dusun,
            'desa' => Desa::find($desa_id),
            'content' => 'admin/dusun/index'
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
        $desa_id = request('desa_id');
        $desa = Desa::find($desa_id);
        $data = [
            'title'   => 'Manajemen Dusun, Desa ' . $desa->name,
            'desa'     => $desa,
            'content' => 'admin/dusun/add'
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
            'desa_id'              => 'required',
            'kecamatan_id'              => 'required',
        ]);

        Dusun::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/wilayah/dusun?desa_id=' . $data['desa_id']);
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
        $dusun = Dusun::find($id);
        $desa_id = request('desa_id');
        $desa = Desa::find($desa_id);
        $data = [
            'title'   => 'Manajemen Dusun, Desa ' . $desa->name,
            'dusun' => $dusun,
            'desa' => $desa,
            'content' => 'admin/dusun/add'
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
        $dusun = Dusun::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'desa_id'              => 'required',
            'kecamatan_id'              => 'required',
        ]);
        $dusun->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/wilayah/dusun?desa_id=' . $data['desa_id']);
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
        $dusun = Dusun::find($id);
        $dusun->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/wilayah/dusun?desa_id=' . $dusun->desa_id);
    }
}
