<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Home(Request $request)
    {
        $user = getUser();
        return view('user.home', compact('user'));
    }

    public function Project(Request $request)
    {
        return view('user.project');
    }

    public function AddProject(Request $request)
    {
        return view('user.add_project');
    }
}
