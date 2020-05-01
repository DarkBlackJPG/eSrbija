<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ModeratorReject - Sends email to potential moderator ih he/she is rejected
 *
 * @package App\MailS
 * @version 1.0
 */
class ModeratorReject extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin_mails.rejectModerator')->subject('Status prijave na sistem e-Srbija');
    }
}
