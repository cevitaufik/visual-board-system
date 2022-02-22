<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemMail extends Mailable
{
    use Queueable, SerializesModels;

    public $detailS;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detailS)
    {
        $this->detailS = $detailS;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation', ['details' => $this->detailS]);
    }
}
