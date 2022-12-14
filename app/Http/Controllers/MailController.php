<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function preview(Request $request){
        return new VerificationMail();
    }

    function kirim(Request $request){
        Mail::to($request->email)->send(new VerificationMail);

        return redirect()->route('view_verifikasi', [
            "email" => $request->email
        ]);
    }
}
