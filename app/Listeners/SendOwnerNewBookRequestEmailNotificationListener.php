<?php

namespace App\Listeners;

use App\Mail\NewBookRequestMail;
use Illuminate\Support\Facades\Mail;

class SendOwnerNewBookRequestEmailNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to($event->book->user->email)->send(new NewBookRequestMail($event));
    }
}
