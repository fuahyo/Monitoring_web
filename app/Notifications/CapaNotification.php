<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CapaNotification extends Notification
{
    use Queueable;
    private $notificationEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationEmail)
    {
        $this->notificationEmail = $notificationEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->notificationEmail['body'])
                    ->action($this->notificationEmail['notificationText'], $this->notificationEmail['url'])
                    ->line($this->notificationEmail['thankyou']);
        // return (new MailMessage)->view('email');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
