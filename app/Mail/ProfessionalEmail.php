<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessionalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyMessage;

    public function __construct($subjectLine, $bodyMessage)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyMessage = $bodyMessage;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('Admin.SendEmail.professional');
    }
}
