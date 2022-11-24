<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function Home(){
        return view('admin.admin');
    }
}
