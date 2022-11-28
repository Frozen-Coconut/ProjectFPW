<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class checkUserProjectRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $project = Project::find(session('projectSekarang'));
        $user = getUser();
        $isManager = $project->project_manager_id == $user->id;
        if($role == 'manager' && !$isManager){
            return redirect()->back();
        }else if($role == 'member' && $isManager){
            return redirect()->back();
        }
        return $next($request);
    }
}
