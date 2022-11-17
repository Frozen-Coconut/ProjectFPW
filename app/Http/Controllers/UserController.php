<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function Kalender(Request $request)
    {
        //Konfigurasi :
        $tgl_terakhir_bulan_ini = 31;
        $tgl_terakhir_bulan_lalu = 31;
        $hari_awal_bulan_ini = 6;
        //Catatan hari awal :
        /*
        0 = Minggu, .. , 6 = Sabtu
        */


        $start = (($tgl_terakhir_bulan_lalu-$hari_awal_bulan_ini)+1)%$tgl_terakhir_bulan_lalu;
        $daftar_hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
        return view('user.kalender',[
            "start" => $start,
            "tgl_terakhir_bulan_ini" => $tgl_terakhir_bulan_ini,
            "tgl_terakhir_bulan_lalu" => $tgl_terakhir_bulan_lalu,
            "daftar_hari" => $daftar_hari
        ]);
    }
}
