<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable klasa za notifikacije o novim obavestenjima iz pretplacenih kategorija.
 * 
 * @author Luka Spehar
 */
class SubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $obavestenje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($obavestenje)
    {
        this.$obavestenje = $obavestenje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscriptions.SubscriptionNotification');
    }
}
