<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Pitanja Model -  Each database table has a corresponding "Model"
 * which is used to interact with that table. Models allow you to query
 * for data in your tables, as well as insert new records into the table.
 *
 * @version 1.0
 */
class Pitanja extends Model
{

    protected $fillable=['tekst'];
    /**
     * This method returns the App\Ankete which this Pitanja belongs to
     *
     * @author Stefan Teslic
     * @return
     */
    public function anketa() {
        return $this->belongsTo('App\Ankete', 'ankete_id');
    }
    /**
     * This method returns all App\PonudjeniOdgovori this pitanja
     * has
     *
     * @author Stefan Teslic
     * @return
     */
    public function odgovori() {
        return $this->hasMany('App\PonudjeniOdgovori', 'pitanja_id', 'id');
    }

    /**
     * pamti pitanje u bazi
     * @param $anketa Anketa za koju se vezuje pitanje
     * @param $tekst String
     * @return mixed
     * @author Filip Carevic
     */
    public static function napraviPitanje($anketa, $tekst){
        return $anketa->pitanja()->create([
            'tekst'=> $tekst
        ]);
    }
}
