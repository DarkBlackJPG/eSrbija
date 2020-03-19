<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    /*
     *  Ovom metodom se vezuje za decu
     */
    public function tabelakorisnika(){
        return $this->morphTo();
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
