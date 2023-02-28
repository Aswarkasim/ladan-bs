<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeLaporanController extends Controller
{
    //
    function index()
    {
        $data = [
            'content'  => 'home/laporan/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
