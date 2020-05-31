<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * PonudjeniOdgovori Model -  Each database table has a corresponding "Model"
 * which is used to interact with that table. Models allow you to query
 * for data in your tables, as well as insert new records into the table.
 *
 * @version 1.0
 */
class PonudjeniOdgovori extends Model
{
    protected $fillable=['tekst'];
    /**
     * This method returns to which App\Pitanja this PonudjeniOdgovori belongsTo
     *
     * @author Stefan Teslic
     * @return App\Pitanja
     */
    public function pitanje(){
        return $this->belongsTo('App\Pitanja', 'pitanja_id');
    }
    /**
     * This method returns to which App\Korisnik this PonudjeniOdgovori belongsTo
     *
     * @example UserA votes for App\PonudjeniOdgovori A and UserB votes fofor App\PonudjeniOdgovori A. Then A belongs to UserA and UserB
     * @return Illuminate\Database\Eloquent\Collection
     * @author Stefan Teslic
     */
    public function korisnici() {
        return $this->belongsToMany('App\Korisnik', 'odgovori_korisniks', 'ponudjeni_odgovori_id', 'korisnik_id');
    }

    /**
     * pamti ponudjen odgovor u bazi
     * @param $pitanje
     * @param $tekst
     * @author Filip Carevic
     */
    public static function napraviOdgovor($pitanje, $tekst){
        $pitanje->odgovori()->create([
            'tekst'=> $tekst
        ]);
    }
}
