<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KeluhanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $loginUrl;

    /**
     * Create a new message instance.
     */
    
public function __construct($data, $loginUrl)
{
    $this->data = $data;
    $this->loginUrl = $loginUrl;
}
    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Keluhan Baru Masuk')
        ->view('emails.keluhan_notification')
        ->with([
            'data' => $this->data,
            'loginUrl' => $this->loginUrl,
        ]);

    }
}
