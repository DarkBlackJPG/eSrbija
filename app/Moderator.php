<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    /*
     * Ovom metodom se vezuje za roditelja
     */
    public function korisnik(){
        return $this->belongsTo('App\Korisnik', 'id', 'id');
    }
    public function opstinaPoslovanja() {
        return $this->belongsTo('App\Mesto', 'opstinaPoslovanja_id', 'id');
    }
}
