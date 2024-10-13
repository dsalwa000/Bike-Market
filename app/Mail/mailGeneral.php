<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailGeneral extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $confirmationMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $confirmationMail) {
        $this->data = $data;
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
            ->view('mail.mailGeneral');
    }
}
