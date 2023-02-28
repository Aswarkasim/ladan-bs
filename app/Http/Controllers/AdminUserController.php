<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
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

        // $role = request('role');
        $user = User::latest()->paginate(10);

        if ($cari) {
            $user = User::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $user = User::latest()->paginate(10);
        }


        $data = [
            'title'   => 'Manajemen User',
            'user' => $user,
            'content' => 'admin/user/index'
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
        $kecamatan = Kecamatan::get();
        // dd($kecamatan);
        // foreach ($kecamatan as $item) {
        //     echo $item->name;
        // }
        // die();
        $data = [
            'title'   => 'Tambah User',
            'datakecamatan' => $kecamatan,
            'content' => 'admin/user/add'
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
        // Re Password harusnya tidak masuk
        $data = $request->validate([
            'name'          => 'required|min:3',
            'email'         => 'required|email|min:4|unique:users',
            'role'          => 'required',
            'kecamatan_id'  => 'required',
            'password'      => 'required|min:4',
            're_password'   => 'required|same:password'
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        Alert::success('Sukses', 'User telah ditambahkan');
        return redirect('/admin/user/create');
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
        $user = User::find($id);
        $data = [
            'title'   => 'Tambah User',
            'user' => $user,
            'content' => 'admin/user/add'
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
        $user = User::find($id);
        $data = $request->validate([
            'name'          => 'required|min:3',
            'email'         => 'required|email|min:4|unique:users,email,' . $user->id,
            'role'          => 'required',
        ]);

        if ($request->password == '') {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        Alert::success('success', 'User telah diedit');
        return redirect('/admin/user/' . $user->id . '/edit');
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
        DB::table('users')->delete($id);
        Alert::success('success', 'User telah dihapus');
        return redirect('/admin/user');
    }
}
