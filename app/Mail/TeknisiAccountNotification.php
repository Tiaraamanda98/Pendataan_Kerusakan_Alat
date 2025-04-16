<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeknisiAccountNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $loginUrl;

    public function __construct($data, $loginUrl)
    {
        $this->data = $data;
        $this->loginUrl = $loginUrl;
    }

    public function build()
    {
        return $this->subject('Akun Teknisi Anda Telah Dibuat')
                    ->view('emails.teknisi_account_notification')
                    ->with([
                        'data' => $this->data,
                        'loginUrl' => $this->loginUrl,
                    ]);
    }
}
