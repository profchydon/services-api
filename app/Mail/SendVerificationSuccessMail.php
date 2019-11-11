<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $status;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$status,$reason)
    {
        $this->name = $name;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->status == "passed") {
            
            return $this->from('hello@54gene.com', 'Xcort.ng')
            ->subject('Congrats! Your Account has been verified')
            ->view('mail.html.activate')
            ->with(['name' => $this->name]);

        }else {
            
            return $this->from('hello@54gene.com', 'Xcort.ng')
            ->subject('Account verification failed')
            ->view('mail.html.activate')
            ->with(['name' => $this->name, 'reason' => $this->reason]);

        }

    }
}
