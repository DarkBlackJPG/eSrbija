<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Ankete Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 */
class Ankete extends Model
{
    /**
     * Fillable fields for Ankete model
     * 
     * @var array $fillable 
     * @author Stefan Teslic
     */
    protected $fillable = ['naziv', 'nivoLokNac', 'obrisanoFlag', 'isActive'];

    /**
     * Relationship method between Ankete and Korisnik model
     * 
     * @return App\Korisnik
     * @author Stefan Teslic
     */
    public function korisnik() {
        return $this->belongsTo('App\Korisnik', 'korisnik_id', 'id');
    }
    /**
     * Relationship method between Ankete and Pitanja model
     * 
     * @return Illuminate\Database\Eloquent\Collection
     * @author Stefan Teslic
     */
    public function pitanja() {
        return $this->hasMany('App\Pitanja', 'ankete_id','id');
    }
    /**
     * Relationship method between Ankete and Mesto model
     * 
     * @return Illuminate\Database\Eloquent\Collection 
     * @author Stefan Teslic
     */
    public function vezanoZaMesto() {
        return $this->belongsToMany('App\Mesto', 'ankete_mestos', 'ankete_id', 'mesto_id');
    }

    
    public static function pitanjaAnketeSaBrojemOdgovoraPoPitanju($id){
        $anketa = Ankete::where('id', $id)->with('pitanja.odgovori.korisnici')->first();
        $pitanja = $anketa->pitanja()->paginate(4);
        $brojOdgovora = array();
        $count = 0;
        $isAnswered = true;
        foreach($pitanja as $pitanje){
            $brojOdgovoraPoPitanju = 0;
            foreach($pitanje->odgovori as $poundjeniOdgovor){
                $brojOdgovoraPoPitanju += count($poundjeniOdgovor->korisnici);
            }
            $brojOdgovora[$pitanje->id] = $brojOdgovoraPoPitanju;
            if($brojOdgovoraPoPitanju == 0){
                $count++;
            }
        }
        if($count == count($brojOdgovora)){
            $isAnswered = false;
        }
        return ["pitanja"=>$pitanja, "brojOdgovora"=>$brojOdgovora, "isAnswered"=> $isAnswered];
    } 
}
