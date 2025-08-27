<?php

use App\Models\User;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Page\Dashboard;
use App\Mail\OtpVerificationMail;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\OtpVerification;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OtpVerificationController;





Route::middleware('guest')->group(function () {

    // Route::get('/login', LoginController::class, 'index')->name('index');
    Route::get('/login', [LoginController::class, 'index'])->name('login');


    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::get('/otp-verification', [OtpVerificationController::class, 'index'])->name('otp-verification');
    // Route::get('/otp/verify', [Register::class, 'showOtpVerification'])->name('otp.verify');

});

// Route::get('send-mail'," [SendMail::class, 'index']);

// Route::get('verify-otp', OtpVerification::class)->name('otp.verify.form');


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    });


    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/transaction', function () {
        return view('pages.transaction');
    })->name('transaction');
});
