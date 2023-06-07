<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     */
    public function __construct($event)
    {
        $this->data['book'] = $event->book;
        $this->data['contact'] = $event->contact;
        $this->data['url'] = $this->getUrl();
    }

    private function getUrl(): string
    {
        return route(
            'book.contact.show',
            [
                $this->data['book']->user->country_id,
                $this->data['contact']->id
            ]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новый запрос на книгу',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact.newBookRequest',
            with: $this->data
        );
    }

}
