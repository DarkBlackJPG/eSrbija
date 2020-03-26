<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorije extends Model
{
    public function obavestenja(){
        return $this->belongsToMany('App\Obavestenja', 'kategorije_obavestenjas', 'kategorije_id', 'obavestenja_id')->withTimestamps();
    }
    public function ovlasceni() {
        return $this->belongsToMany('App\Korisnik', 'kategorije_ovlascenjas', 'kategorije_id', 'korisnik_id')->withTimestamps();
    }
    public function pretplaceni() {
        return $this->belongsToMany('App\Korisnik', 'kategorije_pretplates', 'kategorije_id', 'korisnik_id')->withTimestamps();
    }
 }
