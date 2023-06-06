<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     */
    public function __construct($event)
    {
        $this->data['book'] = $event->book;
        $this->data['userNotificate'] = $event->userNotificate;
        $this->data['url'] = $this->getUrl();
    }

    private function getUrl(): string
    {
        return route(
            'book.contact.show',
            [
                $this->data['userNotificate']->country_id,
                $this->data['book']->id
            ]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новое сообщение в запросе на книгу '.$this->data['book']->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact.newMessageNotification',
            with: $this->data
        );
    }

}
