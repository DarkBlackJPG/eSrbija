<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class EmailVerification - Mailable class that sends an email to user when he/she registers to eSrbija
 *
 * @package App\Mail
 * @version 1.0
 * @author Stefan Teslic
 */
class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @var App\User
     * @return void
     * @author Stefan Teslic
     */
    public function __construct($user)
    {
        $this->url = "http://localhost:8000/user/confirm_mail/".$user->id."/".$user->verification_token;
    }

    /**
     * Poruka se bilduje
     *
     * @return Bildovana poruka tipa Mailable
     * @author Stefan Teslic
     */
    public function build()
    {
        return $this->markdown('emails.auth.verify-email')->with(['url' => $this->url])->subject('Verifikacija prijave na e-Srbiju');
    }
}
