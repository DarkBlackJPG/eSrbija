<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ankete extends Model
{
    protected $fillable = ['naziv', 'nivoLokNac', 'obrisanoFlag', 'isActive'];

    public function korisnik() {
        return $this->belongsTo('App\Korisnik', 'korisnik_id', 'id');
    }
    public function pitanja() {
        return $this->hasMany('App\Pitanja', 'ankete_id','id');
    }
    public function vezanoZaMesto() {
        return $this->belongsToMany('App\Mesto', 'ankete_mestos', 'ankete_id', 'mesto_id');
    }
}
