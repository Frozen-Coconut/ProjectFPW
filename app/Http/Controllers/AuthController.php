<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin(Request $request)
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            "email" => 'required|email|exists:users,email',
            "password" => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
        } else {
            return redirect()->route('login');
        }

        return redirect()->route('user_home');
    }

    public function indexRegister(Request $request)
    {
        return view('register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            "email" => 'required|required|unique:users,email',
            "name" => 'required',
            "password" => 'required|confirmed',
            "password_confirmation" => 'required',
            "occupational_status" => 'required'
        ]);

        User::create($request->all());

        return redirect()->route('register');
    }

    public function doLogout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }
}
