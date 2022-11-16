<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function indexLogin(Request $request)
    {

    }

    public function doLogin(Request $request)
    {
        $request->validate([
            "email" => 'required|email|exists:users,email',
            "password" => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
        }
        else {
            //Kasi pesan ga ketemu
        }

        //Cara ngambilnya getUser();
        //Pindahin ke mana ?

    }

    public function indexRegister(Request $request)
    {

    }

    public function doRegister(Request $request)
    {
        $request->validate([
            "email" => 'required|required|unique:users,email',
            "name" => 'required',
            "password" => 'required|confirmed',
            "occupational_status" => 'required'
        ]);

        User::create($request);
    }
}
