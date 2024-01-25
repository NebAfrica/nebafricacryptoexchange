<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNoQueue extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $subject)
    {
        $this->body = $body;
        $this->subject = $subject; 
             
       

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        $body = $this->body;
        $subject = $this->subject;
        
        return $this
        ->subject($subject)
        ->with('body', $body)               
        ->markdown('mail.email');
        
    }
}
