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
    private $mark;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($result, $mark)
    {
        $this->result = $result;
        $this->mark = $mark;
        $this->queue = 'alertMarkMail';
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
                'mark' => $this->mark,
            ]);
    }
}
