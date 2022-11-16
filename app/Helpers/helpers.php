<?php

use Illuminate\Support\Facades\Auth;

function getUser(){
    if(Auth::guard('web')->check()){
        return Auth::guard('web')->user();
    }
    else{
        return false;
    }
}
