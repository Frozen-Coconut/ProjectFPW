<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function Home(){
        $jumlah_project = Project::count();
	if ($jumlah_project == 0) {
		return view('admin.admin', compact('jumlah_project'));
	}
        $projects_in_months = DB::select('SELECT COUNT(*) AS "count", MONTH(created_at) AS "month" FROM projects GROUP BY MONTH(created_at)');
        $project_array = [];
        for($i = 1; $i <= 12; $i++){
            array_push($project_array, 0);
        }
        foreach($projects_in_months as $item){
            $project_array[$item->month-1] = intval($item->count);
        }
        // dd(json_encode($project_array));

        $data = Project::all()->pluck('status')->toArray();
        // dd($data);
        $upgraded_counter = 0;
        $unupgraded_counter = 0;
        foreach($data as $item){
            if($item == 0) {
                $unupgraded_counter++;
            }
            else $upgraded_counter++;
        }
	if ($upgraded_counter+$unupgraded_counter != 0){
        	$upgraded_percentage = round($upgraded_counter/($upgraded_counter+$unupgraded_counter)*100, 2);
        } else $upgraded_percentage = 0;
	$unupgraded_percentage = 100-$upgraded_percentage;

        $pekerjaan_data = [
            User::where('occupational_status', 0)->count(),
            User::where('occupational_status', 1)->count(),
            User::where('occupational_status', 2)->count(),
            User::where('occupational_status', 3)->count()
        ];


        return view('admin.admin', compact('jumlah_project', 'upgraded_percentage', 'unupgraded_percentage', 'upgraded_counter', 'project_array', 'pekerjaan_data'));
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

    function GetMasterView(Request $request){
        $search = $request->search;
        if ($search == null){
            $users = User::all();
            // dd($users);
        }
        else{
            $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        }
        return view('admin.admin_master', compact('users'));
    }

    function DeleteUser(Request $request){
        $id = $request->id;
        if (User::find($id)->banned == 0){
            User::where('id', $id)->update(['banned' => 1]);
        }
        else{
            User::where('id', $id)->update(['banned' => 0]);
        }


        return back();
    }

    function GetAddUserView(){
        return view('admin.add_user');
    }

    function AddUser(Request $request){
        $request->validate([
            "email" => 'required|email|unique:users,email',
            "name" => 'required',
            "password" => 'required|confirmed',
            "password_confirmation" => 'required',
        ]);
        User::create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => bcrypt($request->password),
            "occupational_status" => 2,
            "role"=> 1,
            "email_verified_at" => now()
        ]);

        return redirect()->route('add_user');
    }
}
