<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function preview(Request $request){
        return new VerificationMail();
    }

    function kirim(Request $request){

        Mail::to($request->email)->send(new VerificationMail(md5($request->email)));

        return redirect()->route('view_verifikasi', [
            "email" => $request->email
        ]);
    }
}
