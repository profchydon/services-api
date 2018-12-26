<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The mail object instance.
     *
     * @var Mail
     */
    public $admin;

    public $invitee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitee , $admin)
    {
        $this->admin = $admin;
        $this->invitee = $invitee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@financialreportingcouncil.com', 'FRC')
        ->subject('You have been added as a FRC admin')
        ->view('vendor.mail.html.mail')
        ->with(['admin' => $this->admin , 'invitee' => $this->invitee]);

    }
}
