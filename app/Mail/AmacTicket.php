<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AmacTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $amacRegistrant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amacRegistrant)
    {
        $this->amacRegistrant = $amacRegistrant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $amacRegistrant = $this->amacRegistrant;

        return $this->view('emails.amacphTicket', compact('amacRegistrant'))
            ->from($address = 'support@ownly.io', $name = 'The Ownly Team')
            ->subject('Your AMAC 2022 Event Ticket is here!')
            ->with('content', $this->amacRegistrant);
    }
}
