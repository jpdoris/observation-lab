<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    public $reviewer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $reviewer)
    {
        $this->report = $report;
        $this->reviewer = $reviewer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.review-added', ['report' => $this->report, 'user' => $this->reviewer]);
    }
}
