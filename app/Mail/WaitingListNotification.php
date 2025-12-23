<?php

namespace App\Mail;

use App\Models\WaitingList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WaitingListNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $waitingList;

    /**
     * Create a new message instance.
     */
    public function __construct(WaitingList $waitingList)
    {
        $this->waitingList = $waitingList;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "🚗 Kabar Gembira! Mobil {$this->waitingList->mobil->merek} {$this->waitingList->mobil->model} Sudah Tersedia!",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.waiting-list-notification',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}