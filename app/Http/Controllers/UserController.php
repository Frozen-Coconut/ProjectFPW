<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class UserController extends Controller
{
    public function Home(Request $request)
    {
        $user = getUser();
        return view('user.home', compact('user'));
    }

    public function AddProject(Request $request)
    {
        return view('user.add_project');
    }

    public function AddProjectPost(Request $request)
    {
        if ($request->has('create')) {
            $request->validate([
                'name_project' => 'required',
                'invitation_code_1' => 'required | unique:projects,invitation_code'
            ], [
                '*.required' => ':attribute harus diisi!',
                'invitation_code_1.unique' => ':attribute tidak tersedia!'
            ], [
                'name_project' => 'Nama project',
                'invitation_code_1' => 'Kode invitasi'
            ]);
            $project = Project::create([
                'name_project' => $request->name_project,
                'invitation_code' => $request->invitation_code_1,
                'project_manager_id' => getUser()->id
            ]);
            $user = getUser();
            User::find($user->id)->projects()->attach(0, [
                'user_id' => $user->id,
                'project_id' => $project->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else if ($request->has('join')) {
            $request->validate([
                'invitation_code_2' => 'required | exists:projects,invitation_code'
            ], [
                '*.required' => ':attribute harus diisi!',
                'invitation_code_2.exists' => ':attribute tidak ditemukan!'
            ], [
                'invitation_code_2' => 'Kode invitasi'
            ]);
            $project = Project::where('invitation_code', $request->invitation_code_2)->first();
            $user = getUser();
            $projects = User::find($user->id)->projects();
            if (!$projects->where('project_id', $project->id)->exists()) {
                User::find($user->id)->projects()->attach(0, [
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                return redirect()->route('user_add_project')->with('message_error', 'User sudah tergabung dalam project tersebut!');
            }
        }
        return redirect()->route('user_home');
    }

    public function IndexKalender(Request $request) {
        return view('user.kalender');
    }

    public function Kalender(Request $request)
    {
        //Konfigurasi :
        $x = $this->isLeapYear($request->year) ? 29 : 28;
        $months =[31, $x, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        $tgl_terakhir_bulan_ini = $months[$request->month] ;

        $monthLalu = $request->month -1 == -1 ? 11 : $request->month-1;
        $tgl_terakhir_bulan_lalu = $months[$monthLalu] ;

        $hari_awal_bulan_ini = $this->findFirstDayMonth($request->month, $request->year);

        //Catatan hari awal :
        /*
        0 = Minggu, .. , 6 = Sabtu
        */

        $start = (($tgl_terakhir_bulan_lalu-$hari_awal_bulan_ini)+1)%$tgl_terakhir_bulan_lalu;
        if ($start == 0 ) $start = $tgl_terakhir_bulan_lalu;
        $daftar_hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
        return view('user.ajax-layout.layout-kalender',[
            "start" => $start,
            "tgl_terakhir_bulan_ini" => $tgl_terakhir_bulan_ini,
            "tgl_terakhir_bulan_lalu" => $tgl_terakhir_bulan_lalu,
            "daftar_hari" => $daftar_hari
        ]);
    }

    public function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    public function findFirstDay($year) {
        $fixedYear = 2020;
        $fixedFirstDay = 3;
        if($year==2020) return $fixedFirstDay;
        if($year>2020){
            $res = $fixedFirstDay;
            for($i=$fixedYear; $i<$year; $i++){
                $res = ($res+($this->isLeapYear($i) ? 366 : 365))%7;
            }
            return $res;
        }
        if($year<2020){
            $res = $fixedFirstDay;
            for($i=$fixedYear-1; $i>=$year; $i--){
                $res = ($res-($this->isLeapYear($i) ? 366 : 365))%7;
            }
            return $res==0 ? 0 : 7+$res;
        }
    }

    public function isLeapYear($year) {
        return $year%400==0 || $year%4==0 && $year%100!=0;
    }

    public function findFirstDayMonth($month, $year) {
        $x = $this->isLeapYear($year)?29:28;
        $months =[31, $x, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        $temp = 0;
        for ($i=0; $i < $month; $i++) {
            $temp += $months[$i];
        }
        $temp = $temp%7;

        return ($this->findFirstDay($year)+$temp)%7;
    }
}
