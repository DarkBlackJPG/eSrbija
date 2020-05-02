<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * NeprivilegovanKorisnik Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 * 
 */
class NeprivilegovanKorisnik extends Model
{
    /**
     * This array is used to define fillable fields for the NeprivilegovanKorisnik model
     * 
     * @var array $fillable
     * @author Stefan Teslic
     */
    protected $fillable = [
        'id',
        'ime',
        'prezime',
        'datumRodjenja',
        'opstinaPrebivalista_id',
        'adresaPrebivalista',
        'jmbg',
        'pol' ,
        'opstinaRodjenja_id' ,
        'brojLicneKarte' ,
    ];
    
    /**
     * Relationship method which represents the relationship between NeprivilegovanKorisnik
     * and App\Korisnik
     * 
     * 
     * @return App\Korisnik
     * @author Stefan Teslic
     */
    public function korisnik(){
        return $this->belongsTo('App\Korisnik', 'id', 'id');
    }
    /**
     * Relationship method which represents the relationship between NeprivilegovanKorisnik
     * and App\Mesto
     * 
     * This method is different from function opstinaPrebivalista() that it returns
     * the App\Mesto where this user was born
     * 
     * @return App\Mesto 
     * @author Stefan Teslic
     */
    public function opstinaRodjenja(){
        return $this->belongsTo('App\Mesto','opstinaRodjenja_id', 'id');
    }
    /**
     * Relationship method which represents the relationship between NeprivilegovanKorisnik
     * and App\Mesto 
     * 
     * This method is different from function opstinaRodjenja() that it returns
     * the App\Mesto where this user lives
     * 
     * @return App\Mesto
     * @author Stefan Teslic
     */
    public function opstinaPrebivalista(){
        return $this->belongsTo('App\Mesto','opstinaPrebivalista_id', 'id');
    }
}
