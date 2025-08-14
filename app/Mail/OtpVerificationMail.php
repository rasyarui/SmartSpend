<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use function Laravel\Prompts\form;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Contracts\Queue\ShouldQueue;

class OtpVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    // public $user;
    // public $otp_code;



    /**
     * Create a new message instance.
     */
    public function __construct(
        public User $user,
        public string $otp_code
    ) {

        // $this->otp_code = $otp_code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('SmartSpend@gmail.com', 'SmartSpend'),
            subject: 'Kode Verifikasi OTP - ' . config('app.name'),

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email-otp',
            with: [
                'user' => $this->user,
                'otp_code' => $this->otp_code,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
