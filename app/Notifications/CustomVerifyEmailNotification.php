<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */

    /**
     * Get the mail representation of the notification.
     */


    public function buildMailMessage($url): MailMessage
    {

        return (new MailMessage)
            ->subject('Подтверждение адреса электронной почты')
            ->greeting('Здравствуйте!')
            ->line('Пожалуйста, нажмите на кнопку ниже, чтобы подтвердить свой адрес электронной почты.')
            ->action('Подтвердить адрес электронной почты', $url)
            ->line('Спасибо за использование нашего приложения!')
            ->salutation('С уважением, ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
