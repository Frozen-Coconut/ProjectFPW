<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = getUser();
        if ($user == false) {
            return redirect()->route('login');
        }
        else if ($user->banned == 1) {
            return redirect()->route('banned');
        }
        else {
            if ($user->role == 1) {
                return redirect()->route('admin_home');
            }
            if ($user->role == 0) {
                if ($user->email_verified_at == null) {
                    return redirect()->route('view_verifikasi', [
                        "email" => $user->email
                    ]);
                }
            }
        }
        return $next($request);
    }
}
