<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function Login(Request $request)
    {
        return view('login');
    }

    public function LoginPost(Request $request)
    {
        if ($request->has('submit')) {
            $user = User::where('email', $request->email)->where('password', $request->password);
            if ($user->exists()) {
                session(['now' => $user->first()->id]);
                return redirect()->route('user_home');
            }
        }
        return redirect()->route('login');
    }
}
