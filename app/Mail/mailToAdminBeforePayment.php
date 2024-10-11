<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;

class mailToAdminBeforePayment extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    
    public function __construct($mailData)
    {
        // dd($mailData);
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject('Analytics Market Research | Ready For Payment !')
        ->from($address = $this->mailData['user_email'], $name = $this->mailData['user_name'])
        ->view('front.Mails.mailToAdminBeforePayment');
    }
}
