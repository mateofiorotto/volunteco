<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class VolunteerRejectedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $volunteerName;
    public $projectName;
    public $rejectionReason;

    public function __construct($volunteerName, $projectName, $rejectionReason)
    {
        $this->volunteerName = $volunteerName;
        $this->projectName = $projectName;
        $this->rejectionReason = $rejectionReason;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tu solicitud de voluntariado fue rechazada - Volunteco",
            from: new Address("volunteco@gmail.com", "Volunteco")
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.volunteer-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
