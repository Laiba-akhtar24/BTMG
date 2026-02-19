<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryReply extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Reply from BTMG Trainings')
                    ->view('emails.inquiry_reply')
                    ->with([
                        'content' => $this->messageContent
                    ]);
    }
}
