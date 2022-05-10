<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $photo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $photo)
    {
        $this->report = $report;
        $this->photo = $photo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A New Report was Added')
                ->view('email.newReportNotification');
    }
}