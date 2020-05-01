<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Administrator Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 */
class Administrator extends Model
{
    /** 
     * Relationship method between Administrator model and Korisnik model
     * 
     * @author Stefan Teslic
     * @return App\Korisnik
     */
    public function korisnik(){
        return $this->belongsTo('App\Korisnik', 'id', 'id');
    }
}
