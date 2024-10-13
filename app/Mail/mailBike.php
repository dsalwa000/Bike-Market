<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailBike extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $bike;
    public $confirmationMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $bike, $confirmationMail)
    {
        $this->data = $data;
        $this->bike = $bike;
        $this->confirmationMail = $confirmationMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Zapytanie')
            ->view('mail.mailBike');
    }
}
