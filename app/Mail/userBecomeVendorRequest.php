<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userBecomeVendorRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_obj)
    {
        $this->user = $user_obj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Alert !! you got a request for seller role.');
        return $this->view('emails.userBecomeVendorRequest', [$this->user]);
    }
}
