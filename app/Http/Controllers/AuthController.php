<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $credential = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($credential)) {
            if (getUser()->role == 1) {
                return redirect()->route('admin_home');
            }

            if (getUser()->email_verified_at == null) {
                return redirect()->route('view_verifikasi', [
                    "email" => $request->email
                ]);
            }

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

        return redirect()->route('kirim_email', [
            "email" => $request->email
        ]);
    }

    public function doLogout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewVerifikasi(Request $request) {
        return view('verification', [
            "email" => $request->email
        ]);
    }

    public function doVerifikasi(Request $request) {
        $request->validate([
            "kode_verif" => 'required'
        ],[
            '*.required' => ':attribute harus diisi!',
        ],[
            'kode_verif' => 'Kode Verifikasi'
        ]);

        if ($request->kode_verif == md5($request->email)) {
            $user = User::where('email','=', $request->email)->first();
            $user->email_verified_at = Carbon::now();
            $user->save();

            if (!getUser()) {
                return redirect()->route('login');
            }
            else {
                return redirect()->route('user_home');
            }
        }
        else {
            return redirect()->route('view_verifikasi', [
                "email" => $request->email
            ]);
        }
    }
}
