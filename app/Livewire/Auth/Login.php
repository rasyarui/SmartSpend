<?php


namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Mail\OtpVerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;




class Login extends Component
{
    public $otp_code = '';
    public $user;
    public string $email = '';
    public string $message = '';
    public string $messageType = '';
    public $isResending = false;


    protected $rules = [
        'email' => 'required|email',

    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }
    public function updated($properyName)
    {
        $this->validateOnly($properyName);
    }

    public function login()
    {
        sleep(1);
        $this->validate();

        $this->user = User::where('email', $this->email)->first();

        if (!$this->user) {
            $this->setMessage('Email tidak terdaftar.', 'error');
            return;
        }

        if ($this->user->hasVerifiedEmail()) {

            Auth::login($this->user);
            session()->regenerate(); 

            $this->showMessage('Login berhasil!', 'success');
            return redirect('/dashboard'); 
        }


        try {
            $this->user->generateOtp();
            $this->user->refresh();

            session(['user_id' => $this->user->id]);

            if ($this->user->otp_code) {
                Mail::to($this->user->email)->send(new OtpVerificationMail($this->user, $this->user->otp_code)); // Pass both user and otp_code
            } else {
                $this->showMessage('Gagal mendapatkan kode OTP untuk pengiriman. Silakan coba lagi.', 'error');
                $this->isResending = false;
                return;
            }


            $this->calculateTimeLeft();
            $this->otp_code = '';
            $this->showMessage('Kode OTP telah dikirim ke email Anda.', 'success');
        } catch (\Exception $e) {
            $this->showMessage('Gagal mengirim OTP. Silakan coba lagi.', 'error');
        }

        session(['user_id_for_otp_verification' => $this->user->id]);

        return $this->redirect('otp-verification', navigate: true);
    }

    public function showMessage($message, $type)
    {
        $this->message = $message;
        $this->messageType = $type;

        $this->dispatch('clearMessage');
    }

    public function setMessage(string $message, string $type = 'info')
    {
        $this->message = $message;
        $this->messageType = $type;
    }
}
