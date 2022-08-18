<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $offer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offerData)
    {
        $this->offer = $offerData;
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
                    ->subject('Hey, New offer is availabe')
                    ->line($this->offer['body'])
                    ->action($this->offer['offerText'], $this->offer['offerUrl'])
                    ->line($this->offer['thanks']);
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
            'offer_id' => $this->offer['offer_id']
        ];
    }
}
