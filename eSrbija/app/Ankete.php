<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    protected $fillable = ['naziv', 'nivoLokNac', 'obrisanoFlag', 'isActive','tip'];

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

    /**
     * Dohvatanje pitanja za anketu sa datim id-ijem sa informacijom o broju odgovora po pitanju
     *
     * @author Dušan Stijović
     * @param id idAnkete
     * @return Illuminate\Database\Eloquent\Collection
     */

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


    /**pamti anketu u bazi podataka
     * @param $naziv String nazivAnkete
     * @param $nivoLokNac int   lokalnost ankete
     * @param $tip int     izbori/referendumi/obicna
     * @return mixed
     *
     * @author Filip Carevic
     */
    public static function napraviAnketu($naziv, $nivoLokNac,$tip){
        return auth()->user()->mojeAnkete()->create( [
            'naziv'=> $naziv,
            'nivoLokNac' => $nivoLokNac,
            'obrisanoFlag' =>false,
            'isActive'=>true,
            'tip' => $tip
        ]);
    }


    /**
     * dohvata sve neobrisane ankete
     * @return \Illuminate\Support\Collection
     * @author Filip Carevic
     */
    public static function dohvatiSveAnkete(){
        return DB::table('anketes')->where('obrisanoFlag' , false)->orderBy('created_at','DESC')->get();

    }

    /**dohvata sve neobrisane ankete koje je ulogovani moderator napravio
     *
     * @return \Illuminate\Support\Collection
     * @author Filip Carevic
     *
     */
    public static function dohvatiSveModeratoroveAnkete(){
        DB::table('anketes')->where(['korisnik_id'=> auth()->user()->id] )->orderBy('created_at','DESC')->get();

    }

    /**
     * dohvata sve aktivne i neodgovorene ankete za datog korisnika
     * @param $userid
     * @return \Illuminate\Support\Collection
     *
     * @author Filip Carevic
     */

    public static function dohvatiSveAktivneINeodgovoreneAnkete($userid){
        return DB::table('anketes')->
        whereRaw("anketes.isActive = 1 and  id not  in
                 ( select a.id
        from anketes a, korisniks, ponudjeni_odgovoris po, pitanjas, odgovori_korisniks
        where a.id=pitanjas.ankete_id and pitanjas.id=po.pitanja_id
        and po.id = odgovori_korisniks.ponudjeni_odgovori_id
         and odgovori_korisniks.korisnik_id = $userid )
         ")->orderBy('created_at', 'DESC')->get();


    }

    /**
     * Proverava da li anketa vezana za zadatog mesto. Vraca null ukoliko nije
     * @param $userMesto
     * @param $anketa
     * @return \Illuminate\Support\Collection
     *
     * @author Filip Carevic
     */
    public static function dohvatiVezuAnketeMesto($userMesto, $anketa){
        return DB::table('ankete_mestos')->where(['mesto_id'=> $userMesto, 'ankete_id' => $anketa->id])->get();

    }

    /**
     * dohvata sve aktivne i neodgovorene ankete po tipu
     * @param $tip izbori*referendumi/obican
     * @param $userid
     * @return \Illuminate\Support\Collection
     * @author Filip Carevic
     *
     */
    public static function dohvatiAktivneINeodgovorenePoTipu($tip, $userid){
        return DB::table('anketes')->
        whereRaw("anketes.isActive = 1 and anketes.tip =$tip and id not  in
                 ( select a.id
        from anketes a, korisniks, ponudjeni_odgovoris po, pitanjas, odgovori_korisniks
        where a.id=pitanjas.ankete_id and pitanjas.id=po.pitanja_id
        and po.id = odgovori_korisniks.ponudjeni_odgovori_id
         and odgovori_korisniks.korisnik_id = $userid )
         ")->orderBy('created_at', 'DESC')->get();
    }


}
