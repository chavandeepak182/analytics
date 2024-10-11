<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mailToAdminAfterPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject('Analytics Market Research | Payment Done !')
        ->from($address = $this->mailData[0]['user_email'], $name = $this->mailData[0]['user_name'])
        ->view('front.Mails.mailToAdminAfterPayment');
    }
}
