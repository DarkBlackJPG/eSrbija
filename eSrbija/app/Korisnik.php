<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;


/**
 * Korisnik Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 * 
 */
class Korisnik extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    /**
     * This array is used to define fillable fields for the Korisnik model
     * 
     * @var array $fillable
     * @author Stefan Teslic
     */
    protected $fillable = [
        'e-mail',

    ];
    /**
     * This array is used to define hidden fields for the korisnik
     * model which are not mass-assignable
     * 
     * @var array $hidden
     * @author Stefan Teslic
     */
    protected $hidden = [
        'password',
        'isAdmin',
        'isMod',
        'remember_token',
    ];
    /**
     * email_verified_at field is defined in DB as timestamp,
     * this field defines that the timestamp should be
     * converted to datetime
     * 
     * @var array $casts
     * @author Stefan Teslic
     */
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
     * 
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }


    /**
     * Relationship method between Korisnik and App\Administrator
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function admini() {
        return $this->hasMany('App\Administrator', 'id', 'id');
    }
     /**
     * Relationship method between Korisnik and App\NeprivilegovanKorisnik
     *
     * @author Stefan Teslic
     * @return App\NeprivilegovanKorisnik
     */
    public function neprivilegovaniKorisnici() {
        return $this->hasOne('App\NeprivilegovanKorisnik', 'id', 'id');
    }
    /**
     * Relationship method between Korisnik and App\Moderator
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function moderatori() {
        return $this->hasMany('App\Moderator', 'id', 'id');
    }
    /**
     * Relationship method between Korisnik and App\Kategorije
     *
     * This method is different from function pretplate() because
     * it returns the App\Kategorije array which this user is
     * priveleged to post about
     * 
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function ovlascenja(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_ovlascenjas', 'korisnik_id', 'kategorije_id');
    }
    /**
     * Relationship method between Korisnik and App\Kategorije
     *
     * This method is different from function ovlascenja() because
     * it returns the App\Kategorije array which this user is
     * subscribed to recieve notifications
     * 
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function pretplate(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_pretplates', 'korisnik_id', 'kategorije_id');
    }
    /**
     * Relationship method between Korisnik and App\PonudjeniOdgovori
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function sviOdgovori(){
        return $this->belongsToMany('App\PonudjeniOdgovori', 'odgovori_korisniks', 'korisnik_id', 'ponudjeni_odgovori_id');
    }
    /**
     * Relationship method between Korisnik and App\Ankete
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function mojeAnkete(){
        return $this->hasMany('App\Ankete', 'korisnik_id', 'id');
    }
    /**
     * Relationship method between Korisnik and App\Obavestenja
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function mojaObavestenja(){
        return $this->hasMany('App\Obavestenja', 'korisnik_id', 'id');
    }
}
