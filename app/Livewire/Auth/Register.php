<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpVerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;





class Register extends Component
{
    public string $message = '';
    public string $messageType = '';
    public $name = '';
    public $email = '';
    public $password = '';

    public $otp_code;
    public $user;
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function updated($properyName)
    {
        $this->validateOnly($properyName);
    }


    protected $rules = [
        'name' => ['required', 'max:225'],
        'email' => ['', 'email', 'unique:users'],
        'password' => ['', 'min:8',],
        // 'password_confirmation' => ['' ,'min:8', 'confirmed'],
    ];


    public function register(Request $request)
    {
        $this->validate(); // Lakukan validasi input

        try {
            // 1. Buat user baru (email_verified_at akan NULL secara default)
            $this->user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            // 2. Generate OTP untuk user baru
            // Pastikan metode generateOtp() di model User Anda mengembalikan kode OTP
            $this->otp_code = $this->user->generateOtp();
            $this->user->refresh(); // Penting untuk refresh model setelah generateOtp()

            // 3. Kirim email OTP
            if ($this->user->otp_code) {
                Mail::to($this->user->email)->send(new OtpVerificationMail($this->user, $this->user->otp_code));
            } else {
                $this->showMessage('Gagal membuat kode OTP. Silakan coba lagi.', 'error');
                // Hapus user yang baru dibuat jika pengiriman OTP gagal kritis (opsional)
                $this->user->delete();
                return;
            }

            // 4. Simpan ID user ke sesi untuk digunakan di halaman verifikasi OTP
            session(['user_id' => $this->user->id]); // Kunci 'user_id' ini harus konsisten

            // 5. Redirect ke halaman verifikasi OTP
            $this->showMessage('Registrasi berhasil! Kode verifikasi telah dikirim ke email Anda.', 'success');
            return $this->redirect('/otp-verification', navigate: true);
        } catch (\Exception $e) {
            // Tangani error, misal gagal mengirim email atau masalah database
            $this->showMessage('Terjadi kesalahan saat pendaftaran. Silakan coba lagi.', 'error');
        }
    }

    public function showMessage($message, $type)
    {
        $this->message = $message;
        $this->messageType = $type;

        // Clear message after 5 seconds
        $this->dispatch('clearMessage');
    }

    public function setMessage(string $message, string $type = 'info')
    {
        $this->message = $message;
        $this->messageType = $type;
    }
}
