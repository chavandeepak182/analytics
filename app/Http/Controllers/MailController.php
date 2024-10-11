<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactThankYouMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => "WE MARKET RESEARCH.",
            'body' => "WE MARKET RESEARCH."
        ];

        \Mail::to('mplussoftesting@gmail.com')->send(new ContactThankYouMail($mailData));
        return redirect('/webPortal-login')->with('success', 'Email is sent successfully.');
        
    }
}