<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTicket extends Mailable
{
    use Queueable, SerializesModels;
    public $restaurante;
    public $asunto;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($restaurante,$asunto,$pdf)
    {   
        $this->restaurante =$restaurante;
        $this->asunto =$asunto;
        $this->pdf=$pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->view('email.send-email-ticket')->subject($this->asunto)->attachData($this->pdf->output(),'ticket.pdf');
    }
}
