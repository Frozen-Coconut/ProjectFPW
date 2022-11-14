<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Home(Request $request)
    {
        return view('user.home');
    }

    public function Project(Request $request)
    {
        return view('user.project');
    }
}
