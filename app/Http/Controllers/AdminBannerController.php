<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banner = Banner::paginate(10);
        $data = [
            'title'   => 'Manajemen Banner',
            'banner' => $banner,
            'content' => 'admin/banner/index'
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
            'title'   => 'Manajemen Banner',
            'content' => 'admin/banner/add'
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
        $data = $request->validate([
            'topik'        => 'required',
            'urutan'        => 'required|unique:banners',
            'desc'              => 'required|min:3',
            'image'              => 'required:mimes:jpg,png',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/banners/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = NULL;
        }

        Banner::create($data);
        Alert::success('Sukses', 'Banner telah ditambahkan');
        return redirect('/admin/banner');
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
        $data = [
            'title'   => 'Manajemen Banner',
            'banner'    => Banner::find($id),
            'content' => 'admin/banner/add'
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
        //
        // die('Adakah');
        $banner = Banner::find($id);
        $data = $request->validate([
            'topik'         => 'required',
            'image'         => 'mimes:jpeg,jpg,png,bmp',
            'urutan'        => 'required|unique:banners,urutan,' . $banner->id,
            'desc'          => 'required|min:3',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {

            if ($banner->image != '') {
                unlink($banner->image);
            }

            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/banners/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = 'null';
        }

        $banner->update($data);
        Alert::success('Sukses', 'Banner telah diubah');
        return redirect('/admin/banner');
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
    }
}
