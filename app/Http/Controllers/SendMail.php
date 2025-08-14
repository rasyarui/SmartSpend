<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Mail;

class SendMail extends Controller
{
    public function index(){
        // Mail::to('rasyajago12@gmail.com')->send(new OtpVerificationMail());
    }
}
