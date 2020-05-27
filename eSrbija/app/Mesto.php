<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Mesto Model -  Each database table has a corresponding "Model"
 * which is used to interact with that table. Models allow you to query
 * for data in your tables, as well as insert new records into the table.
 *
 * @version 1.0
 *
 */
class Mesto extends Model
{
    /**
     * This method represents the relationship between Mesto and App\NeprivilegovaniKorisnik
     *
     * This method is different from function neprivilegovaniRodjenje() because
     * it returns the App\Mesto where every user lives currently
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function neprivilegovaniPrebivaliste(){
        return $this->hasMany('App\NeprivilegovaniKorisnik', 'opstinaPrebivalista_id', 'id');
    }
    /**
     * This method represents the relationship between Mesto and App\NeprivilegovaniKorisnik
     *
     * This method is different from function neprivilegovaniPrebivaliste() because
     * it returns App\Mesto where every user was born
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function neprivilegovaniRodjenje() {
        return $this->hasMany('App\NeprivilegovaniKorisnik', 'opstinaRodjenja_id', 'id');
    }
    /**
     * This method represents the relationship between Mesto and App\Moderator
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function moderatoriPoslovanje() {
        return $this->hasMany('App\Moderator', 'opstinaPoslovanja_id', 'id');
    }
    /**
     * This method represents the relationship between Mesto and App\ZahteviModerator
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function zahtevaniModeratoriPoslovanje() {
        return $this->hasMany('App\ZahteviModerator', 'opstinaPoslovanja_id', 'id');
    }
    /**
     * This method represents the relationship between Mesto and App\Obavestenja
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function obavestenja(){
        return $this->belongsToMany('App\Obavestenja', 'mesto_obavestenjes', 'mesto_id', 'obavestenje_id');
    }
    /**
     * This method represents the relationship between Mesto and App\Ankete
     *
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function ankete()
    {
        return $this->belongsToMany('App\Ankete', 'ankete_mestos', 'mesto_id', 'ankete_id');
    }

    public static function dohvatiSveNaziveMesta(){
        return DB::table('mestos')->get('naziv');
    }
    
    public static function dohvatiMestoPoNazivu($naziv){
        return DB::table('mestos')->where('naziv',$naziv)->first();
    }









}
