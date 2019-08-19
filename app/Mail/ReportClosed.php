<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportClosed extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    public $closedby;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $closedby)
    {
        $this->report = $report;
        $this->closedby = $closedby;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.report-closed', ['report' => $this->report, 'closedby' => $this->closedby]);
    }
}
