<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ToDo;
use App\Models\Project;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function AddSession(Request $request) {
        Session::put('projectSekarang', $request->id);
        Session::put('tipeProjectSekarang', Project::find($request->id)->status);
        

        return redirect()->route('project_home');
    }

    public function AddMember(Request $request)
    {
        $arr = $request->member;

        $rules = [
            'email' => 'required | email | exists:users',
        ];

        DB::beginTransaction();

        foreach ($arr as $value) {
            $data = [
                'email' => $value
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                DB::rollBack();
                $failedRules = $validator->failed();
                if(isset($failedRules['email']['email'])) {
                    return response()->json(['error'=>'Email not valid!'], 400);
                }else if(isset($failedRules['email']['exists'])) {
                    return response()->json(['error'=>'Email not exist!'], 404);
                }
            }


            $projects = User::where('email', '=', $value)->first()->projects();
            $project_now = Session::get('projectSekarang');
            $checked_user = User::where('email', '=', $value)->first();

            if (!$projects->where('project_id', $project_now)->exists()) {
                $checked_user->projects()->attach(0, [
                    'user_id' => $checked_user->id,
                    'project_id' => $project_now,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                DB::rollBack();
                return response()->json(['error'=>'User sudah bergabung!'], 400);
            }

        }

        DB::commit();
        return response()->json(['message'=>'User berhasil ditambahkan!'], 200);
    }

    public function SearchMember(Request $request)
    {
        $query = $request->search;
        if(!$query){
            return null;
        }

        $user_outside_project = User::whereNotIn(
            'id', Project::find(Session::get('projectSekarang'))->users()->pluck('users.id')
        )->where(function($quer) use ($query){
            $quer->where('email', 'like', '%'. $query.'%')
            ->orWhere('name', 'like', '%'. $query.'%');
        })
        ->limit(3)
        ->get();

        if(count($user_outside_project) > 0){
            return $user_outside_project;
        }else{
            return null;
        }
    }

    public function Member(Request $request)
    {
        $project_member = Project::find(Session::get('projectSekarang'))->users()->get();
        // dd($project_member);
        $project = Project::find(session('projectSekarang'));
        $user = getUser();

        return view('project.daftar_member', compact('project_member', 'project', 'user'));
    }

    public function Project(Request $request)
    {
        $project = Project::find(session('projectSekarang'));
        $user = getUser();
        return view('project.project', [
            "project" => $project,
            "user" => $user
        ]);
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

    public function IndexNotification(Request $request) {
        $user = getUser();
        $user->notifications()->where('project_id','=',Session::get('projectSekarang'))->where('status','=',1)->update([
            "status" => 2
        ]);

        return view('project.notification');
    }

    public function Notification(Request $request) {

        $notification = getUser()->notifications()->where('project_id','=',Session::get('projectSekarang'))->where('status','<',3)->get();

        return view('project.ajax-layout.layout-notifikasi', [
            "notification" => $notification
        ]);
    }

    public function DeleteNotification(Request $request) {
        getUser()->notifications()->where('id','=',$request->id)->update([
            "status" => 3
        ]);
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
            "project_sekarang" => $project_sekarang,
            "edit" => 0
        ]);
    }

    public function EditDaftarTugas(Request $request)
    {
        $project_sekarang = Project::find(Session::get('projectSekarang'));
        $to_do_sekarang = ToDo::find($request->id);

        return view('project.add_daftar_tugas', [
            "project_sekarang" => $project_sekarang,
            "edit" => 1,
            "to_do_sekarang" => $to_do_sekarang
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
            if($key == false) {
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

        foreach($to_do->users as $user) {
            if ($user->pivot->status == 1) {
                $notifikasiAmbil = Notification::where('project_id','=',$to_do->project_id)->where('user_id','=',$user->id)->first();
                if ($notifikasiAmbil == null || $notifikasiAmbil->status == 3) {
                    Notification::create([
                        "content" => 'Cepat kerjakan to do '.$to_do->name,
                        "status" => 1,
                        "user_id" => $user->id,
                        "project_id" => $to_do->project_id
                    ]);
                }
            }
        }
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
        $x = $this->isLeapYear($request->year) ? 29 : 28;
        $months =[31, $x, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        $tgl_terakhir_bulan_ini = $months[$request->month] ;

        $monthLalu = $request->month -1 == -1 ? 11 : $request->month-1;
        $tgl_terakhir_bulan_lalu = $months[$monthLalu] ;

        $hari_awal_bulan_ini = $this->findFirstDayMonth($request->month, $request->year);

        $start = (($tgl_terakhir_bulan_lalu-$hari_awal_bulan_ini)+1)%$tgl_terakhir_bulan_lalu;
        if ($start == 0 ) $start = $tgl_terakhir_bulan_lalu;
        $daftar_hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

        $tanggal_deadline = [];
        foreach (getUser()->to_dos()->where('project_id','=',Session::get('projectSekarang'))->get() as $key => $value) {
            if (date("m", strtotime($value->deadline)) == str_pad(($request->month+1).'',2,'0',STR_PAD_LEFT)) {
                $tanggal_deadline[(int)date("d",strtotime($value->deadline))] = 1;
            }
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

        $project_sekarang = Project::find(Session::get('projectSekarang'));
        $status = $project_sekarang->status;
        return view('project.upgrade', compact('status'));
    }
}
