<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Korisnik extends Authenticatable
{
    protected $fillable = [
        'e-mail',
        'password'
    ];

    use Notifiable;
    /*
     *  Ovom metodom se vezuje za decu
     */
    public function admini() {
        return $this->hasMany('App\Administrator', 'id', 'id');
    }
    public function neprivilegovaniKorisnici() {
        return $this->hasMany('App\NeprivilegovanKorisnik', 'id', 'id');
    }
    public function moderatori() {
        return $this->hasMany('App\Moderator', 'id', 'id');
    }
    public function ovlascenja(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_korisnik_ovlascenjas', 'korisnik_id', 'kategorije_id')->withTimestamps();
    }
    public function pretplate(){
        return $this->belongsToMany('App\Kategorije', 'kategorije_korisnik_pretplates', 'korisnik_id', 'kategorije_id')->withTimestamps();
    }
    public function sviOdgovori(){
        return $this->belongsToMany('App\PonudjeniOdgovori', 'odgovori_korisnik', 'korisnik_id', 'ponudjeni_odgovori_id')->withTimestamps();
    }
    public function mojeAnkete(){
        return $this->hasMany('App\Ankete', 'korisnik_id', 'id')->withTimestamps();
    }
    public function mojaObavestenja(){
        return $this->hasMany('App\Obavestenja', 'korisnik_id', 'id')->withTimestamps();
    }
}
