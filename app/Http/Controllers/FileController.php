<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function Main(Request $request)
    {
        return view('file.main');
    }

    public function Upload(Request $request)
    {
        return view('file.upload');
    }

    public function Edit(Request $request)
    {
        return view('file.edit');
    }
}
