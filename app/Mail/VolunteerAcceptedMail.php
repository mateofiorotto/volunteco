<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class VolunteerAcceptedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $volunteerName;
    public $projectName;

    /**
     * Create a new message instance.
     */
    public function __construct($volunteerName, $projectName)
    {
        $this->volunteerName = $volunteerName;
        $this->projectName = $projectName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Fuiste aceptado en un proyecto - Volunteco",
            from: new Address("volunteco@gmail.com", "Volunteco")
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.volunteer-accepted',
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
