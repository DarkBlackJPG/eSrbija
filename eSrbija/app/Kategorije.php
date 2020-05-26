<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Kategorije Model -  Each database table has a corresponding "Model"
 * which is used to interact with that table. Models allow you to query
 * for data in your tables, as well as insert new records into the table.
 *
 * @version 1.0
 */
class Kategorije extends Model
{

    /**
     * Relationship method which binds Kategorije with Obavestenja model
     *
     * @return Illuminate\Database\Eloquent\Collection
     * @author Stefan Teslic
     */
    public function obavestenja(){
        return $this->belongsToMany('App\Obavestenja', 'kategorije_obavestenjas', 'kategorije_id', 'obavestenja_id');
    }
    /**
     * Relationship method which binds Kategorije with  Korisnik model
     *
     * This method is different from function pretplaceni() in the sense
     * that every user has privilages to post something with predefined
     * categories.
     *
     * @return Illuminate\Database\Eloquent\Collection
     * @author Stefan Teslic
     */
    public function ovlasceni() {
        return $this->belongsToMany('App\Korisnik', 'kategorije_ovlascenjas', 'kategorije_id', 'korisnik_id')->withTimestamps();
    }
    /**
     * Relationship method which binds Kategorije with  Korisnik model
     *
     * This method is different from function ovlasceni() in the sense
     * that every user can subscribe to certain categories and recieve
     * notifications
     *
     * @return Illuminate\Database\Eloquent\Collection
     * @author Stefan Teslic
     */
    public function pretplaceni() {
        return $this->belongsToMany('App\Korisnik', 'kategorije_pretplates', 'kategorije_id', 'korisnik_id');
    }
    public static function Dohvati_nazive_svih_kategorija(){
        return DB::table('kategorijes')->select('naziv')->get();
    }
 }
