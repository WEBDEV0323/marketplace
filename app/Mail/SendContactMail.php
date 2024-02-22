<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; 
    public $attachmentPath;

    public function __construct($data , $attachmentPath)
    {
        $this->data = $data;
        $this->attachmentPath = $attachmentPath; 
    }

    public function build()
    {
       return $this->view('emails.sendContactMail')->subject('New Query Received')->attach($this->attachmentPath, [
                        'as' => $this->attachmentPath, 
                    ]);
    }
}
