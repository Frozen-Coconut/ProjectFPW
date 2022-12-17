<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class File
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
        if (!session()->has('tipeProjectSekarang')) {
            return redirect()->route('user_home');
        }
        if (session('tipeProjectSekarang') == 0) {
            return redirect()->route('project_home');
        }
        return $next($request);
    }
}
