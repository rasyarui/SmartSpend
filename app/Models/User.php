<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_code',
        'otp_expires_at',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            
        ];
    }

    public function generateOtp()
    {
        $this->otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->otp_expires_at = Carbon::now()->addMinutes(2); // OTP expires in 10 minutes
        $this->save();
        return $this->otp_code;
    }

    public function isOtpValid($otp)
    {
        return $this->otp_code === $otp &&
            $this->otp_expires_at &&
            Carbon::now()->lessThan($this->otp_expires_at);
    }
    public function isOtpExpired()
    {
        return $this->otp_expires_at && Carbon::now()->greaterThan($this->otp_expires_at);
    }
    public function clearOtp()
    {
        $this->otp_code = null;
        $this->otp_expires_at = null;
        $this->save();
    }

    public function verify()
    {
        $this->is_verified = true;
        $this->email_verified_at = Carbon::now();
        $this->clearOtp();
    }
}
