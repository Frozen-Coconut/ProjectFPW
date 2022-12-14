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
        

        Mail::to('liantoleonard9@gmail.com')->send(new VerificationMail);
    }
}
