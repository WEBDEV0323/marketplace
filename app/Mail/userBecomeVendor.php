<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userBecomeVendor extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $subject;
    public $view;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_obj,$subject,$view)
    {
        $this->user = $user_obj;
        $this->subject = $subject;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('discovermasroorab@gmail.com')
        ->subject($this->subject)
        ->view($this->view);
    }
}
