<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    private $subjects;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjects)
    {
        $this->subjects = $subjects;
        $this->queue = 'alertMail';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.alert-subject')
            ->subject('THÔNG BÁO ĐĂNG KÍ MÔN HỌC')
            ->with([
                'subjects' => $this->subjects
            ]);
    }
}
