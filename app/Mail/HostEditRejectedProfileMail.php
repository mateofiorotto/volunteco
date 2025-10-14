<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class HostEditRejectedProfileMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $link;
    public $fieldsToChange;
    public $hostFullName;

    /**
     * Create a new message instance.
     */
    public function __construct($link, $fieldsToChange, $hostFullName)
    {
        $this->fieldsToChange = $fieldsToChange;
        $this->link = $link;
        $this->hostFullName = $hostFullName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tu solicitud de registro ha sido rechazada / Tu perfil fue deshabilitado - Volunteco",
            from: new Address("volunteco@gmail.com", "Volunteco")
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.host-edit-rejected-profile',
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
