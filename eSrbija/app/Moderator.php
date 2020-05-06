<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Mesto Model -  Each database table has a corresponding "Model"
 * which is used to interact with that table. Models allow you to query
 * for data in your tables, as well as insert new records into the table.
 *
 * @version 1.0
 *
 */
class Moderator extends Model
{
    /**
     * This array is used to define fillable fields for the Moderator model
     *
     * @var array $fillable
     * @author Stefan Teslic
     */
    protected $fillable = [
        'id',
        'approved',
        'naziv',
        'adresa',
        'pib',
        'maticniBroj',
        'opstinaPoslovanja_id',
        'lokalnost',
        'ankete',
    ];


    /**
     * This is a relationship method which shows the relationship between
     * Moderator and App\Korisnik
     *
     * @author Stefan Teslic
     * @return App\Korisnik
     */
    public function korisnik(){
        return $this->belongsTo('App\Korisnik', 'id', 'id');
    }
    /**
     * This is a relationship method which shows the relationship between
     * Moderator and App\Mesto
     *
     * @author Stefan Teslic
     * @return App\Mesto
     */
    public function opstinaPoslovanja() {
        return $this->belongsTo('App\Mesto', 'opstinaPoslovanja_id', 'id');
    }

}
