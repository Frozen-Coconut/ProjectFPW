<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function AddSession(Request $request) {
        Session::put('projectSekarang', $request->id);

        return redirect()->route('project_home');
    }

    public function Project(Request $request)
    {
        return view('project.project');
    }

    public function IndexDaftarTugas(Request $request)
    {
        return view('project.daftar_tugas');
    }

    public function AddDaftarTugas(Request $request)
    {
        $project_sekarang = Project::find(Session::get('projectSekarang'));

        return view('project.add_daftar_tugas', [
            "project_sekarang" => $project_sekarang
        ]);
    }

    public function DaftarTugas(Request $request) {
        $daftar_tugas = getUser()->to_dos()->where('project_id','=',Session::get('projectSekarang'))->get();

        return view('project.ajax-layout.layout-daftar-tugas',[
            "daftar_tugas" => $daftar_tugas
        ]);
    }
}
