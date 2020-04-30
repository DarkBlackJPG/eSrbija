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
