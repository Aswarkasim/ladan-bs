<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Rt;
use Illuminate\Http\Request;

class AdminRtController extends Controller
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
        $dusun_id = request('dusun_id');
        $tahun = auth()->user()->tahun;

        if ($cari) {
            $rt = Rt::whereDusunId($dusun_id)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $rt = Rt::whereDusunId($dusun_id)->latest()->paginate(10);
        }

        $dusun = Dusun::find($dusun_id);
        $data = [
            'title'   => 'Manajemen Rt, Dusun ' . $dusun->name,
            'rt' => $rt,
            'dusun' => $dusun,
            'content' => 'admin/rt/index'
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
        $dusun_id = request('dusun_id');
        $dusun = Dusun::find($dusun_id);
        $data = [
            'title'   => 'Manajemen Rt, Dusun ' . $dusun->name,
            'dusun' => $dusun,
            'content' => 'admin/rt/add'
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
            'name'              => 'required',
            'dusun_id'              => 'required',
            'desa_id'              => 'required',
            'kecamatan_id'              => 'required',
        ]);
        Rt::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/wilayah/rt?dusun_id=' . $data['dusun_id']);
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
        $rt = Rt::find($id);
        $dusun_id = request('dusun_id');
        $dusun = Dusun::find($dusun_id);
        $data = [
            'title'   => 'Manajemen Rt, Dusun ' . $dusun->name,
            'rt' => $rt,
            'dusun' => $dusun,
            'content' => 'admin/rt/add'
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
        $rt = Rt::find($id);
        $data = $request->validate([
            'name'              => 'required',
            'dusun_id'              => 'required',
            'desa_id'              => 'required',
            'kecamatan_id'              => 'required',
        ]);
        $rt->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/wilayah/rt?dusun_id=' . $data['dusun_id']);
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
        $rt = Rt::find($id);
        $rt->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/wilayah/rt?dusun_id=' . $rt->dusun_id);
    }
}
