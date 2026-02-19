<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $messageText; // The message content

    /**
     * Create a new message instance.
     */
    public function __construct($messageText)
    {
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Message from BTMG')
                    ->view('emails.subscriber_message'); // we’ll create this view next
    }
}
