<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ModeratorReject - Reprezentuje mail objekat koji salje mejl koji treba da javi osobi da li je
 * zahtev za moderatora odbijen
 * @package App\MailS
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
