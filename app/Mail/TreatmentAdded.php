<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TreatmentAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    public $treatedby;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $treatedby)
    {
        $this->report = $report;
        $this->treatedby = $treatedby;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.treatment-added', ['report' => $this->report, 'user' => $this->treatedby]);
    }
}
