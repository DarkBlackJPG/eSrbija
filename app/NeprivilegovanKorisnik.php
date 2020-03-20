<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeprivilegovanKorisnik extends Model
{
    /*
     * Ovom metodom se vezuje za roditelja
     */
    public function korisnik(){
        return $this->belongsTo('App\Korisnik', 'id', 'id');
    }
    public function opstinaRodjenja(){
        return $this->belongsTo('App\Mesto','opstinaRodjenja_id', 'id');
    }
    public function opstinaPrebivalista(){
        return $this->belongsTo('App\Mesto','opstinaPrebivalista_id', 'id');
    }
}
