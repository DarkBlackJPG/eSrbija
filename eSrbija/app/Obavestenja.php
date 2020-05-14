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

    /** Sluzi za dohvatanje svih obavestenja moderatora sa dartim id-ijem
    *
    *@author Dušan Stijović
    *@param id idMoredatora
    *@return Illuminate\Database\Eloquent\Collection
    */
    public static function svaObavestenjaModeratora($id){
       return Obavestenja::where(['korisnik_id' => $id, 'obrisanoFlag' => false])->paginate(4);
    }


      /** Sluzi za dohvatanja obavestenja koja su relevantna za korisnika sa datim idijem i za dato mesto 
    *
    *@author Dušan Stijović
    *@param id idMoredatora
    *@param idMesto idMesta
    *@return Illuminate\Database\Eloquent\Collection
    */
    public static function svaObavestenjaZaKategorijuIMestoKorisnika($id, $idMesto){
        
        $kategorija = Kategorije::where("id", '=' , $id)->first();
        $obavestenja = $kategorija->obavestenja()->where('obrisanoFlag', false)->paginate(4);
        
        foreach ($obavestenja as  $key => $obavestenje){
            if($obavestenje->nivoLokNac == 0){
                //Sta prikazati adminu, sve ili nema tu opciju
                $mesta = $obavestenje->vezanoZaMesto;

                $mesta_id = [];
                $found = false;
                foreach ($mesta as $mesto){
                    if($mesto->id == $idMesto)
                        $found = true;
                }

                if( !found ){
                    $obavestenja->forget($key);
                }
            }
        }
        
        return $obavestenja;

    }


}
