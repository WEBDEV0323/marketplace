<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($name , $email , $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function build()
    {
        return $this->view('emails.signupMail' , [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ])->subject('Sign Up Mail');
    }
}
