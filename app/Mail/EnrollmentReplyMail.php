<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentReplyMail extends Mailable
{
    use SerializesModels;

    public $replyMessage;
    public $studentName;
    public $courseName;

    public function __construct($replyMessage, $studentName, $courseName)
    {
        $this->replyMessage = $replyMessage;
        $this->studentName = $studentName;
        $this->courseName = $courseName;
    }

    public function build()
    {
        return $this->subject('Regarding Your Course Enrollment')
                    ->view('emails.enrollment-reply');
    }
}
