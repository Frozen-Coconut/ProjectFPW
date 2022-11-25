<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function Home(){
        // $managers = DB::select('SELECT users.name, COUNT(*) FROM projects JOIN users ON users.id = projects.project_manager_id GROUP BY projects.project_manager_id, users.name');
        // //dd($managers);

        // $workers =DB::select('SELECT COUNT(user_id) FROM users_projects GROUP BY project_id');
        // //dd($workers);

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


        return view('admin.admin', compact('upgraded_counter', 'unupgraded_counter'));
    }
}
