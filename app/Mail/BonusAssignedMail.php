<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BonusAssignedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $employee;
    public $bonus;
   
    public function __construct($employee, $bonus)
    {
        $this->employee = $employee;
        $this->bonus = $bonus;
    }

    public function build()
    {
        return $this->subject('New Bonus Assigned')
                    ->view('emails.bonus_assigned');
    }
}
