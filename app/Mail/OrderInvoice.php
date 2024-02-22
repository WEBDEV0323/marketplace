<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $order;
    public $billing;
    public $shipping;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $billing, $shipping)
    {
        $this->user = $user;
        $this->order = $order;
        $this->billing = $billing;
        $this->shipping = $shipping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Order invoice '.$this->order->reference);
        return $this->view('emails.order-invoice', [$this->user, $this->order, $this->billing, $this->shipping]);    
    }
}
