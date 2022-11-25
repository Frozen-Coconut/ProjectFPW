<?php

namespace App\Http\Controllers;

use Midtrans;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\HTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\Midtrans\CallbackService;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\Midtrans as MidtransMidtrans;

class SnapController extends Controller
{
    function GetSnap(Request $request) {
        $project = Project::where('id','=',Session::get('projectSekarang'))->first();
        $user = getUser();

        //Buat order id

        $kode = Str::upper(Str::substr($project->name_project, 0, 3));
        $count = rand(100000, 999999);

        $kode = $kode.$count;

        HTransaction::create([
            'transaction_id' => $kode,
            'project_id' => Session::get('projectSekarang'),
            'amount' => 100000,
            'transaction_method' => 0,
            'status' => 1
        ]);

        $parameter = [
            "transaction_details" => [
                'order_id' => $kode,
                'gross_amount' => '100000'
            ],
            "item_details" => [
                [
                    'id' => 1,
                    'price' => '100000',
                    'name' => 'Upgrade Project '.$project->name_project,
                    'quantity' => 1
                ],
            ],
            "customer_details" => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];
        $midtrans = new CreateSnapTokenService($parameter);
        $snapToken = $midtrans->getSnapToken();
        return $snapToken;
    }

    public function Receive(Request $request)
    {
        $htrans = HTransaction::where('transaction_id', '=', $request->order_id)->first();

        if ($request->status == 2) {
            Project::where('id', '=', $htrans->project_id)->update([
                "status" => 1
            ]);
        }

        $htrans->status = $request->status;
        $htrans->transaction_method = $request->payment_type;
        $htrans->save();

        if($request->status == 2){
            Project::where('id', $htrans->project_id)
            ->update(['status'=> 1]);
        }
    }
}
