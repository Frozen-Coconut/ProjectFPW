<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function Home(){
        $projects_in_months = DB::select('SELECT COUNT(*) AS "count", MONTH(created_at) AS "month" FROM projects GROUP BY MONTH(created_at)');
        $project_array = [];
        for($i = 1; $i <= 12; $i++){
            array_push($project_array, 0);
        }
        foreach($projects_in_months as $item){
            $project_array[$item->month-1] = $item->count;
        }
        // dd(json_encode($project_array));

        $data = Project::all()->pluck('status')->toArray();
        // dd($data);
        $upgraded_counter = 0;
        $unupgraded_counter = 0;
        foreach($data as $item){
            if($item == 0) {
                $upgraded_counter++;
            }
            else $unupgraded_counter++;
        }
        return view('admin.admin', compact('upgraded_counter', 'unupgraded_counter', 'project_array'));
    }

    function ProjectList(){
        $projects = Project::all();

        return view('admin.admin_projects', compact('projects'));
    }

    function AdminViewProject(Request $request ){
        Session::put('projectSekarang', $request->id);
        Session::put('tipeProjectSekarang', Project::find($request->id)->status);

        return redirect()->route('project_home');
    }

    function AdminViewProjectDetail(Request $request) {
        $project = Project::where('id','=',$request->id)->first();

        return view('admin.admin_project_detail',[
            "project" => $project
        ]);
    }
}
