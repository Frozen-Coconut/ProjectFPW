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
        //untuk sementara
        if ($request->email == "admin" && $request->password == "admin"){
            return redirect()->route('admin_home');
        }
        $request->validate([
            "email" => 'required|email|exists:users,email',
            "password" => 'required'
        ]);

        $credential = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($credential)) {
            return redirect()->route('user_home');
        } else {
            return redirect()->route('login')->with('message_error', 'Password salah!');
        }
    }

    public function indexRegister(Request $request)
    {
        return view('register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            "email" => 'required|email|unique:users,email',
            "name" => 'required',
            "password" => 'required|confirmed',
            "password_confirmation" => 'required',
            "occupational_status" => 'required'
        ]);
        User::create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => bcrypt($request->password),
            "occupational_status" => $request->occupational_status
        ]);

        return redirect()->route('login');
    }

    public function doLogout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }
}
