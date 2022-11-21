<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ToDo;
use App\Models\Project;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function AddSession(Request $request) {
        Session::put('projectSekarang', $request->id);
        Session::put('tipeProjectSekarang', Project::find($request->id)->status);

        return redirect()->route('project_home');
    }

    public function Project(Request $request)
    {
        $project = Project::find(session('projectSekarang'));
        return view('project.project', compact('project'));
    }

    public function AddPost(Request $request)
    {
        $request->validate([
            'post' => 'required'
        ]);
        Post::create([
            'project_id' => session('projectSekarang'),
            'user_id' => getUser()->id,
            'contents' => $request->post
        ]);
        return redirect()->route('project_home');
    }

    public function DetailPost(Request $request)
    {
        $post = Post::find($request->id);
        return view('project.detail_post', compact('post'));
    }

    public function AddPostComment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        PostComment::create([
            'user_id' => getUser()->id,
            'post_id' => $request->id,
            'contents' => $request->comment
        ]);
        return redirect()->back();
    }

    public function IndexDaftarTugas(Request $request)
    {
        return view('project.daftar_tugas',[
            "user" => getUser(),
            "project" => Project::where('id','=',Session::get('projectSekarang'))->first()
        ]);
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

        if ($request->pm == 0) {
            $daftar_tugas = Project::where('id','=',Session::get('projectSekarang'))->first()->to_dos();
        }

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
                    if ($request->pm == 0) {
                        //Kosongin
                    }
                    else {
                        $daftar_tugas = $daftar_tugas->orderBy('pivot_weights','ASC');
                    }
            }
        }

        $daftar_tugas = $daftar_tugas->get();

        $tgl_sekarang = Carbon::now();

        return view('project.ajax-layout.layout-daftar-tugas',[
            "daftar_tugas" => $daftar_tugas,
            "user" => getUser(),
            "project" => Project::where('id','=',Session::get('projectSekarang'))->first(),
            "tgl_sekarang" => $tgl_sekarang
        ]);
    }

    public function UpdateCustomSort(Request $request) {

        $user = getUser();

        foreach ($user->to_dos()->where('project_id','=',Session::get('projectSekarang'))->get() as $key => $value) {
            $key = array_search($value->id,$request->id);
            if($key === false) {
                $value->pivot->weights = count($request->id) + 1;
                $value->pivot->save();
            }
            else {
                $value->pivot->weights = $request->value[$key];
                $value->pivot->save();
            }
        }
    }

    public function NotifyLate(Request $request) {
        $to_do = ToDo::where('id',$request->id)->first();

        dd($to_do->users);
    }

    public function IndexDetailTugas(Request $request) {
        $to_do = ToDo::where('id','=',$request->id)->first();
        $status = -1;
        if (getUser()->id != Project::where('id','=',Session::get('projectSekarang'))->first()->project_manager_id) {
            $status = $to_do->users()->where('user_id','=',getUser()->id)->first()->pivot->status;
        }

        return view('project.detail_tugas',[
            "to_do" => $to_do,
            "status" => $status,
            "user" => getUser(),
            "project" => Project::where('id','=',Session::get('projectSekarang'))->first(),
        ]);
    }

    public function UpdateStatus(Request $request) {
        $to_do = ToDo::where('id','=',$request->id)->first();

        $user = $to_do->users()->where('user_id','=',getUser()->id)->first();

        $user->pivot->status = $request->status;
        $user->pivot->save();

        return redirect()->route('project_detail_tugas', [
            "id" => $request->id
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

    public function IndexUpgrade(Request $request) {
        return view('project.upgrade');
    }
}
