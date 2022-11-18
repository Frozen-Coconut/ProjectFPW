<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function Home(Request $request)
    {
        $user = getUser();
        return view('user.home', compact('user'));
    }

    public function Project(Request $request)
    {
        return view('user.project');
    }

    public function AddProject(Request $request)
    {
        return view('user.add_project');
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
