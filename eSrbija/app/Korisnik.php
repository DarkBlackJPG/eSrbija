<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class Korisnik extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;


    protected $fillable = [
        'e-mail',

    ];
    protected $hidden = [
        'password',
        'isAdmin',
        'isMod',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Overrides the sendPasswordResetNotification(string $token) function
     * from the CanResetPassword class.
     *
     * This method is called when the user requests a mail with the password
     * reset link be sent to his email address
     *
     * @param string $token
     * @author Stefan Teslic
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }


    /**
     * Relationship functions
     *
     * @author Stefan Teslic
     */

    public function admini() {
        return $this->hasMany('App\Administrator', 'id', 'id');
    }
    public function neprivilegovaniKorisnici() {
        return $this->hasOne('App\NeprivilegovanKorisnik', 'id', 'id');
    }
    public function moderatori() {
        return $this->hasMany('App\Moderator', 'id', 'id');
    }
    public function ovlascenja(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_ovlascenjas', 'korisnik_id', 'kategorije_id');
    }
    public function pretplate(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_pretplates', 'korisnik_id', 'kategorije_id');
    }
    public function sviOdgovori(){
        return $this->belongsToMany('App\PonudjeniOdgovori', 'odgovori_korisnik', 'korisnik_id', 'ponudjeni_odgovori_id');
    }
    public function mojeAnkete(){
        return $this->hasMany('App\Ankete', 'korisnik_id', 'id');
    }
    public function mojaObavestenja(){
        return $this->hasMany('App\Obavestenja', 'korisnik_id', 'id');
    }
}
