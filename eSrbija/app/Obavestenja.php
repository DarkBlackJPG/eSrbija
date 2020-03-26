<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obavestenja extends Model
{
    public function korisnik() {
        return $this->belongsTo('App\Korisnik', 'korisnik_id');
    }
    public function pripadaKategorijama(){
        return $this->belongsToMany('App\Kategorije','kategorije_obavestenjas', 'obavestenja_id', 'kategorije_id');
    }

    public function vezanoZaMesto() {
        return $this->belongsToMany('App\Mesto', 'mesto_obavestenjes', 'obavestenje_id', 'mesto_id');
    }
}
