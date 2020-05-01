<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ModeratorApprove - Sends email to potential moderator ih he/she is approved
 *
 * @package App\Mail
 * @version 1.0
 */
class ModeratorApprove extends Mailable
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
     * @return vraca Mailable objekat
     */
    public function build()
    {
        return $this->markdown('emails.admin_mails.approveModerator')->subject('Status prijave na sistem e-Srbija');
    }
}
