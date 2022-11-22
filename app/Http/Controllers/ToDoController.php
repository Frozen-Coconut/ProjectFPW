<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ToDoComment;
use Illuminate\Support\Facades\Session;

class ToDoController extends Controller
{
    public function CreateToDo(Request $request) {

        $request->validate([
            "name_tugas" => 'required',
            "deadline" => 'after_or_equal:today'
        ], [
            '*.required' => ':attribute harus diisi!',
            'deadline.after_or_equal' => ':attribute tidak boleh sebelum hari ini!'
        ],[
            "name_tugas" => 'Nama Tugas',
            "deadline" => 'Deadline'
        ]);

        ToDo::create([
            "name" => $request->name_tugas,
            "project_id" => $request->id_project,
            "deadline" => $request->deadline,
            "tag" => $request->tag
        ]);

        return redirect()->route('project_add_tugas');
    }

    public function AssignToDo(Request $request) {

        $request->validate([
            "user" => 'required|numeric|min:0',
            "tugas" => 'required|numeric|min:0',
        ],[
            '*.required' => ':attribute harus diisi!',
            '*.min:0' => ':attribute harus dipilih',
        ],[
            'tugas' => 'Tugas',
            'user' => 'Pengguna'
        ]);

        $user = User::find($request->user);
        if ($user->to_dos()->where('to_do_id','=', $request->tugas)->count() == 0) { //Kasi pengecekan kalau udah pernah dikasi
            $user->to_dos()->attach(0,[
                "user_id" => $request->user,
                "to_do_id" => $request->tugas,
                "created_at" => now(),
                "updated_at" => now()
            ]);

            Session::flash('succMsg', 'Tugas berhasil ditugaskan !');
            return redirect()->route('project_add_tugas');
        }
        else {
            Session::flash('errMsg', 'Tugas sudah pernah ditugaskan !');
            return redirect()->route('project_add_tugas');
        }
    }

    public function Comment(Request $request) {
        $request->validate([
            "comment" => 'required'
        ],[
            '*.required' => ':attribute harus diisi!',
        ],[
            'comment' => 'Komentar'
        ]);

        ToDoComment::create([
            "user_id" => getUser()->id,
            "to_do_id" => $request->id_to_do,
            "contents" => $request->comment
        ]);

        return redirect()->route('project_detail_tugas', [
            "id" => $request->id_to_do
        ]);
    }
}
