<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductListedByVendor extends Mailable
{
    use Queueable, SerializesModels;
    public $vendor;
    public $product;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendor, $product)
    {
        $this->vendor = $vendor;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Alert !! A new product is listed by the seller.');
        return $this->view('emails.productListedByVendor', [$this->vendor, $this->product]);
    }
}
