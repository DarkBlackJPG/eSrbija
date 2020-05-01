<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Obavestenja Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 */
class Obavestenja extends Model
{
    /**
     * This method returns the App\Korisnik that created this Obavestenja
     * 
     * @author Stefan Teslic
     * @return App\Korisnik
     */
    public function korisnik() {
        return $this->belongsTo('App\Korisnik', 'korisnik_id');
    }
    /**
     * This method returns all App\Kategorije which this Obavestenja belongs to
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function pripadaKategorijama(){
        return $this->belongsToMany('App\Kategorije','kategorije_obavestenjas', 'obavestenja_id', 'kategorije_id');
    }
    /**
     * This method returns all App\Mesto this Obavestenje is bound to
     * 
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */

    public function vezanoZaMesto() {
        return $this->belongsToMany('App\Mesto', 'mesto_obavestenjas', 'obavestenja_id', 'mesto_id');
    }

    public static function svaObavestenjaModeratora($id){
       return Obavestenja::where(['korisnik_id' => $id, 'obrisanoFlag' => false])->paginate(4);
    }
}
