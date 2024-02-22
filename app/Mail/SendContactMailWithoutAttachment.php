<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMailWithoutAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $data; 
    public $attachmentPath;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
       return $this->view('emails.sendContactMail')->subject('New Query Received');
    }
}
