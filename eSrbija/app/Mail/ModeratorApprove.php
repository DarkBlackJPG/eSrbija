<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ModeratorApprove - Salje se mejl moderatoru sa statusom da li je prihvacen
 * @package App\Mail
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
