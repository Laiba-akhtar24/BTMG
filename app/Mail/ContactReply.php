<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    // Constructor receives the reply message
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Reply from Admin')
                    ->view('emails.contact_reply') // Blade view for email
                    ->with(['content' => $this->messageContent]);
    }
}
