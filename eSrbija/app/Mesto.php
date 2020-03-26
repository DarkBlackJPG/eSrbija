<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesto extends Model
{
    public function neprivilegovaniPrebivaliste(){
        return $this->hasMany('App\NeprivilegovaniKorisnik', 'opstinaPrebivalista_id', 'id');
    }
    public function neprivilegovaniRodjenje() {
        return $this->hasMany('App\NeprivilegovaniKorisnik', 'opstinaRodjenja_id', 'id');
    }
    public function moderatoriPoslovanje() {
        return $this->hasMany('App\Moderator', 'opstinaPoslovanja_id', 'id');
    }
    public function zahtevaniModeratoriPoslovanje() {
        return $this->hasMany('App\ZahteviModerator', 'opstinaPoslovanja_id', 'id');
    }
    public function obavestenja(){
        return $this->belongsToMany('App\Obavestenja', 'mesto_obavestenjes', 'mesto_id', 'obavestenje_id');
    }
    public function ankete() {
        return $this->belongsToMany('App\Ankete', 'ankete_mestos', 'mesto_id', 'ankete_id');
    }
}
