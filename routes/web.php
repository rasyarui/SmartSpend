<?php

use App\Http\Controllers\SendMail;
use App\Models\User;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Page\Dashboard;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\OtpVerification;





Route::middleware('guest')->group(function () {

    Route::get('/login', Login::class)->name('login');

    Route::get('/register', Register::class)->name('register');
    Route::get('/otp-verification', OtpVerification::class)->name('otp-verification');
    // Route::get('/otp/verify', [Register::class, 'showOtpVerification'])->name('otp.verify');

});

// Route::get('send-mail', [SendMail::class, 'index']);

// Route::get('verify-otp', OtpVerification::class)->name('otp.verify.form');


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    });


    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });
});
