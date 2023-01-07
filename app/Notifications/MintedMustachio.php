<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class MintedMustachio extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mustachioDet)
    {
        $this->mustachio = $mustachioDet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $mustachio = $this->mustachio;

        return (new SlackMessage)
                    ->success()
                    ->content('We have a newly minted Mustachio!')
                    ->attachment(function ($attachment) use ($mustachio) {
                        $attachment->title("Token ID #$mustachio->id: $mustachio->name")
                                    ->content($mustachio->description);
                    });
    }
}
