<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ProjectDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hostName;
    public $projectTitle;

    /**
     * Create a new message instance.
     */
    public function __construct($hostName, $projectTitle)
    {
        $this->hostName = $hostName;
        $this->projectTitle = $projectTitle;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Eliminamos tu proyecto " . $this->projectTitle . " - Volunteco",
            from: new Address("volunteco@gmail.com", "Volunteco")
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.project-deleted',
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
