<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ModeratorEmailVerification - Salje mail poruku sa potvrdom da je zahtev za moderatora prihvacen
 * @package App\Mail
 */
class ModeratorEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * @author Stefan Teslic
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     * @author Stefan Teslic
     */
    public function build()
    {
        return $this->markdown('emails.auth.moderator-verification')->subject('Potvrda poslatog zahteva za registraciju');
    }
}
