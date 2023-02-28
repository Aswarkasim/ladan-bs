<?php

namespace App\Http\Controllers;

use App\Models\Indikatorstunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminIndikatorStuntingController extends Controller
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
        $tahun = auth()->user()->tahun;

        if ($cari) {
            $indikatorstunting = Indikatorstunting::where('desc', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $indikatorstunting = Indikatorstunting::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Indikatorstunting',
            'indikatorstunting' => $indikatorstunting,
            'content' => 'admin/indikatorstunting/index'
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
        $data = [
            'title'   => 'Manajemen Indikatorstunting',
            'content' => 'admin/indikatorstunting/add'
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
            'desc'              => 'required|min:3',
        ]);
        Indikatorstunting::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/tahunan/stunting/indikatorstunting');
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
        $indikatorstunting = Indikatorstunting::find($id);
        $data = [
            'title'   => 'Edit Indikatorstunting',
            'indikatorstunting' => $indikatorstunting,
            'content' => 'admin/indikatorstunting/add'
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
        $indikatorstunting = Indikatorstunting::find($id);
        $data = $request->validate([
            'desc'              => 'required|min:3',
        ]);
        $indikatorstunting->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/tahunan/stunting/indikatorstunting');
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
        DB::table('indikatorstuntings')->delete($id);
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/tahunan/stunting/indikatorstunting');
    }
}
