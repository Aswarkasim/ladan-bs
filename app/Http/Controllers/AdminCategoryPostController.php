<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCategoryPostController extends Controller
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
            $kategori = Kategori::where('nama', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $kategori = Kategori::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Kategori',
            'kategori' => $kategori,
            'content' => 'admin/kategori/index'
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
            'title'   => 'Manajemen Kategori Artikel',
            'content' => 'admin/kategori/add'
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
            'nama'              => 'required|min:3',
        ]);
        Kategori::create($data);
        Alert::success('Sukses', 'Kategori telah ditambahkan');
        return redirect('/admin/posts/kategori');
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
        $kategori = Kategori::find($id);
        $data = [
            'title'   => 'Edit Kategori',
            'kategori' => $kategori,
            'content' => 'admin/kategori/add'
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
        $kategori = Kategori::find($id);
        $data = $request->validate([
            'nama'              => 'required|min:3',
        ]);
        $kategori->update($data);
        Alert::success('Sukses', 'Kategori telah diubah');
        return redirect('/admin/posts/kategori');
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
        DB::table('kategoris')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/posts/kategori');
    }
}
