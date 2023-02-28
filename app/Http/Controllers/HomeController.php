<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        //
        $data = [
            'banner'    => Banner::get(),
            'post'     => Post::with('category')->paginate(8),
            'content'  => 'home/home/index'
        ];
        return view('home/layouts/wrapper', $data);
    }


    public function tentang()
    {
        //
        $data = [
            'content'  => 'home/tentang/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
