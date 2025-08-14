<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class OtpVerification extends Component
{
    public $otp_code = '';
    public $user;
    public $id;
    public $timeLeft = 0;
    public $isExpired = false;
    public $isResending = false;
    public $message = '';
    public $messageType = '';

    public $email;

    public $showEditEmailModal = false;

    protected $rules = [
        'otp_code' => 'required|string|size:6',
        // 'email' => 'required|exists:users,email', // <--- UBAH DI SINI


    ];

    protected $messages = [
        'otp.required' => 'Kode OTP wajib diisi.',
        'otp.size' => 'Kode OTP harus 6 digit.',
        // 'email.exists' => 'Email ini belum terdaftar. Silakan daftar terlebih dahulu.',

    ];


    public function updated($properyName)
    {
        $this->validateOnly($properyName);
    }

    public function mount()
    {

        if (!session('user_id')) {
            return $this->redirect('register', navigate: true);
        }

        $this->user = User::find(session('user_id'));

        if (!$this->user) {
            return $this->redirect('register', navigate: true);
        }

        if ($this->user->hasVerifiedEmail()) {
            Auth::login($this->user);
            session()->forget('user_id');
            return $this->redirect('/dashboard', navigate: true);
        }
        $this->calculateTimeLeft();
    }

    public function calculateTimeLeft()
    {
        if ($this->user && $this->user->otp_expires_at) {
            $now = Carbon::now();
            $expiresAt = Carbon::parse($this->user->otp_expires_at);

            if ($now->greaterThan($expiresAt)) {
                $this->timeLeft = 0;
                $this->isExpired = true;
            } else {
                $this->timeLeft = $now->diffInSeconds($expiresAt);
                $this->isExpired = false;
            }
        } else {
            $this->timeLeft = 0;
            $this->isExpired = true;
        }
    }

    public function verifyOtp()
    {
        $this->validate();

        // Refresh user data
        $this->user->refresh();

        if ($this->user->isOtpExpired()) {
            $this->isExpired = true;
            $this->showMessage('Kode OTP telah kadaluarsa. Silakan kirim ulang.', 'error');
            return;
        }

        if (!$this->user->isOtpValid($this->otp_code)) {
            $this->showMessage('Kode OTP tidak valid. Periksa kembali kode yang Anda masukkan.', 'error');
            return;
        }

        // Verify user
        $this->user->verify();

        // Clear session
        session()->forget('otp_user_id');

        // Login user
        Auth::login($this->user);

        $this->showMessage('Akun Anda berhasil diverifikasi!', 'success');

        // Redirect to dashboard
        $this->redirect('/dashboard');
    }

    public function resendOtp()
    {
        $this->isResending = true;

        try {
            // Generate new OTP
            $this->user->generateOtp();
            $this->user->refresh();

            // Send OTP email
            // Mail::to($this->user->email)->send(new OtpVerificationMail($this->user));
            if ($this->user->otp_code) { // Add a check to ensure otp_code exists
                Mail::to($this->user->email)->send(new OtpVerificationMail($this->user, $this->user->otp_code)); // Pass both user and otp_code
            } else {
                $this->showMessage('Gagal mendapatkan kode OTP untuk pengiriman. Silakan coba lagi.', 'error');
                $this->isResending = false;
                return;
            }


            $this->calculateTimeLeft();
            $this->otp_code = '';
            $this->showMessage('Kode OTP baru telah dikirim ke email Anda.', 'success');
        } catch (\Exception $e) {
            $this->showMessage('Gagal mengirim OTP. Silakan coba lagi.', 'error');
        }

        $this->isResending = false;
    }


    public function updateEmailAndResendOtp() // Ganti nama dari editEmailAndResendOtp menjadi lebih spesifik
    {
        // Validasi hanya email yang baru
        $this->validateOnly('email');

        // Periksa apakah email benar-benar berubah
        if ($this->user->email === $this->email) {
            $this->showMessage('Email tidak berubah. Mengirim ulang OTP ke email yang sama.', 'info');
            $this->resendOtp(); // Panggil metode resendOtp yang sudah ada
            $this->showEditEmailModal = false; // Tutup modal
            return;
        }

        // Update email user di database
        try {
            $this->user->email = $this->email;
            $this->user->email_verified_at = null; // Set kembali ke NULL karena email berubah
            $this->user->save(); // Simpan perubahan

            $this->user->refresh(); // Refresh objek user setelah disimpan

            // Kirim OTP baru ke email yang baru
            $otpCode = $this->user->generateOtp();
            $this->user->refresh(); // Refresh lagi setelah generateOtp untuk memastikan otp_code terupdate

            Mail::to($this->user->email)->send(new OtpVerificationMail($this->user, $otpCode));

            $this->calculateTimeLeft(); // Hitung ulang waktu kedaluwarsa
            $this->otp_code = ''; // Bersihkan input OTP
            $this->showMessage('Email Anda telah diperbarui dan kode OTP baru telah dikirim ke email tersebut.', 'success');
            $this->showEditEmailModal = false; // <--- TUTUP MODAL SETELAH SUKSES

        } catch (\Exception $e) {

            $this->showMessage('Gagal memperbarui email atau mengirim OTP baru. Silakan coba lagi.', 'error');
        }
    }

    public function openEditEmailModal()
    {
        $this->showEditEmailModal = true;
        $this->email = $this->user->email; // Pastikan email di modal selalu terisi dengan email saat ini
    }

    public function closeEditEmailModal()
    {
        $this->showEditEmailModal = false;
        // Opsional: reset error validasi untuk email saat modal ditutup
        $this->resetValidation('email');
    }


    public function updatedOtp()
    {
        // Auto-format OTP input
        $this->otp_code = preg_replace('/[^0-9]/', '', $this->otp_code);

        if (strlen($this->otp_code) > 6) {
            $this->otp_code = substr($this->otp_code, 0, 6);
        }

        // Auto-verify when 6 digits are entered
        if (strlen($this->otp_code) === 6) {
            $this->verifyOtp();
        }
    }

    public function showMessage($message, $type)
    {
        $this->message = $message;
        $this->messageType = $type;

        // Clear message after 5 seconds
        $this->dispatch('clearMessage');
    }

    public function clearMessage()
    {
        $this->message = '';
        $this->messageType = '';
    }

    public function render()
    {

        return view('livewire.auth.otp-verification');
    }
}
