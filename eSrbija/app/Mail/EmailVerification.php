<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * @author Stefan Teslic
     */

    public function __construct($user)
    {
        $this->url = "http://localhost:8000/user/confirm_mail/".$user->id."/".$user->verification_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     * @author Stefan Teslic
     */
    public function build()
    {
        return $this->markdown('emails.auth.verify-email')->with(['url' => $this->url])->subject('Verifikacija prijave na e-Srbiju');
    }
}
