<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeIkhtisarController extends Controller
{
    //
    function index()
    {
        $data = [
            'content'  => 'home/ikhtisar/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
