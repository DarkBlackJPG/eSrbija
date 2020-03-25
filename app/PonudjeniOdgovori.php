<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PonudjeniOdgovori extends Model
{
    protected $fillable=['tekst'];
    public function pitanje(){
        return $this->belongsTo('App\Pitanja', 'pitanja_id');
    }
    public function korisnici() {
        return $this->belongsToMany('App\Korisnik', 'odgovori_korisnik', 'ponudjeni_odgovori_id', 'korisnik_id');
    }
}
