<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PassengerAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $ride;
    protected $user;

    public function __construct($ride, $user)
    {
        $this->ride = $ride;
        $this->user = $user;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'ride_id' => $this->ride->id,
            'user_id' => $this->user->id,
            'message' => $this->user->name . ' wants to join your ride to ' . $this->ride->destination,
            'url' => '/rides/' . $this->ride->id,
        ];
    }
}
