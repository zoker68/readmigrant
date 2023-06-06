<?php

namespace App\Listeners;

use App\Mail\NewMessageNotificationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewMessageEmailNotificationListener
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
        $event->userNotificate = auth()->user()->id !== $event->book->user_id ? $event->book->user : User::find($event->contact->from_user_id);

        Mail::to($event->userNotificate->email)->send(new NewMessageNotificationMail($event));
    }
}
