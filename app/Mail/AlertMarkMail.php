<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertMarkMail extends Mailable
{
    use Queueable, SerializesModels;

    private $result;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.alert-mark')
            ->subject('ALERT YOUR MARK')
            ->with([
                'result' => $this->result,
            ]);
    }
}
