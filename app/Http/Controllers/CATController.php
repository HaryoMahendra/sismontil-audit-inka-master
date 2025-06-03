<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CATController extends Controller
{
    public function index()
    {
        return view('cat.index'); 
    }

    public function ofi()
    {
        return view('cat.ofi');
    }

    public function ncr()
    {
        return view('cat.ncr');
    }
}
