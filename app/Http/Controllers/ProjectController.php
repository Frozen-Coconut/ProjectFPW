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
        $daftar_tugas = getUser()->to_dos()->where('project_id','=',Session::get('projectSekarang'));

        if ($request->search) {
            $daftar_tugas = $daftar_tugas->where('tag','like','%'.$request->search.'%');
        }

        if ($request->sort || $request->sort != -1) {
            switch($request->sort) {
                case(0):
                    $daftar_tugas = $daftar_tugas->orderBy('name','DESC');
                case(1):
                    $daftar_tugas = $daftar_tugas->orderBy('name','ASC');
                case(2):
                    $daftar_tugas = $daftar_tugas->orderBy('deadline','DESC');
                case(3):
                    $daftar_tugas = $daftar_tugas->orderBy('deadline','ASC');
                case(4):
                    $daftar_tugas = $daftar_tugas->orderBy('pivot_weights','ASC');
            }
        }

        $daftar_tugas = $daftar_tugas->get();

        return view('project.ajax-layout.layout-daftar-tugas',[
            "daftar_tugas" => $daftar_tugas
        ]);
    }

    public function IndexKalender(Request $request) {
        return view('project.kalender');
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

        $tanggal_deadline = [];
        foreach (getUser()->to_dos()->where('project_id','=',Session::get('projectSekarang'))->get() as $key => $value) {
            $tanggal_deadline[date("d",strtotime($value->deadline))] = 1;
        }

        return view('user.ajax-layout.layout-kalender',[
            "start" => $start,
            "tgl_terakhir_bulan_ini" => $tgl_terakhir_bulan_ini,
            "tgl_terakhir_bulan_lalu" => $tgl_terakhir_bulan_lalu,
            "daftar_hari" => $daftar_hari,
            "tanggal_deadline" => $tanggal_deadline
        ]);
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

    public function DetailKalender(Request $request) {
        $date = $request->year.'-'.($request->month+1).'-'.$request->day;
        $daftar_tugas = getUser()->to_dos()->where('deadline','=',$date)->where('project_id','=',Session::get('projectSekarang'))->get();

        return view('user.ajax-layout.layout-detail-kalender',[
            "daftar_tugas" => $daftar_tugas
        ]);
    }
}
