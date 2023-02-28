<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostController extends Controller
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
            $post = Post::where('nama', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $post = Post::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Artikel',
            'post' => $post,
            'content' => 'admin/post/index'
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
            'title'   => 'Tambah Artikel',
            'kategori'  => Kategori::get(),
            'content' => 'admin/post/add'
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
            'kategori_id'        => 'required',
            'title'              => 'required|min:3',
            'image'              => 'required:mimes:jpg',
            'body'              => 'required|min:3',
        ]);
        $data['user_id']    = 0;
        $data['slug']    = Str::random(10) . '-' . strtolower(str_replace(' ', '-', $data['title']));
        $data['excerpt'] = Str::limit(strip_tags($data['body']));

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/images/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = NULL;
        }

        Post::create($data);
        Alert::success('Sukses', 'Artikel telah ditambahkan');
        return redirect('/admin/posts/post');
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
        $data = [
            'title'   => 'Tambah Artikel',
            'kategori'  => Kategori::get(),
            'post'      => Post::find($id),
            'content' => 'admin/post/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //

        $data = [
            'title'   => 'Tambah Artikel',
            'kategori'  => Kategori::get(),
            'post' => Post::where('slug', $slug)->first(),
            'content' => 'admin/post/add'
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
    public function update(Request $request, $slug)
    {
        //
        $post = Post::where('slug', $slug)->first();
        $data = $request->validate([
            'kategori_id'        => 'required',
            'title'              => 'required|min:3',
            'image'              => 'mimes:jpeg,jpg,png,bmp',
            'body'              => 'required|min:3',
        ]);
        $data['user_id']    = 0;
        $data['slug']    = Str::random(10) . '-' . strtolower(str_replace(' ', '-', $data['title']));
        $data['excerpt'] = Str::limit(strip_tags($data['body']));

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {

            if ($post->image != '') {
                unlink($post->image);
            }

            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/images/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = $post->image;
        }

        $post->update($data);
        Alert::success('Sukses', 'Artikel sukses disimpan');
        return redirect('/admin/posts/post/' . $data['slug'] . '/edit');
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
        $post = Post::find($id);
        if ($post->image != '') {
            unlink($post->image);
        }
        $post->delete();
        Alert::success('Sukses', 'Artikel sukses dihapus');
        return redirect('/admin/posts/post/');
    }
}
