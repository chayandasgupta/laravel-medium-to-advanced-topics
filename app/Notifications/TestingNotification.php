<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestingNotification extends Notification
{
    use Queueable;
    private $notificationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notifiableData)
    {   
        $this->notificationData = $notifiableData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {   
        return ['mail', 'database'];
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
                    ->line($this->notificationData['body'])
                    ->action($this->notificationData['notificationText'], $this->notificationData['url'])
                    ->line($this->notificationData['thankyou']);
    }


     /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * 
     */
    public function toDatabase($notifiable)
    {
        return [
            'amount' => 1000,
            'invoice_status' => 'Pay Now',
            'date' => '20-02-22'
        ];
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
