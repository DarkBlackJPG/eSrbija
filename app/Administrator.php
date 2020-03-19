<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    /*
     * Ovom metodom se vezuje za roditelja
     */
    public function korisnik(){
        return $this->morphMany('App\Korisnik', 'tabelakorisnika');
    }
}
