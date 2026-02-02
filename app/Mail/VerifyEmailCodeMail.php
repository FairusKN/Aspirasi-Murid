<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $code;
    protected string $full_name;
    protected int $minutes;

    /**
     * Create a new message instance.
     */
    public function __construct(string $code, string $full_name, int $minutes = 5)
    {
        $this->code = $code;
        $this->full_name = $full_name;
        $this->minutes = $minutes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('auth.email_verification_title'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.verify',
            with: [
                'code' => $this->code,
                'full_name' => $this->full_name,
                'minutes' => $this->minutes
            ]
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
