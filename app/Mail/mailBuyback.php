<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class mailBuyback extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $zipDirectory;
    public $confirmationMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $confirmationMail) {
        $this->data = $data;
        $this->zipDirectory = Storage::path('buyback-pdf/newBike.zip');
        $this->confirmationMail = $confirmationMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('New bike')
            ->view('mail.mailBuyback')
            ->attach($this->zipDirectory);
    }
}


