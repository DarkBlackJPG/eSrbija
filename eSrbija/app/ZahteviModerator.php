<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ZahteviModerator Model -  Each database table has a corresponding "Model" 
 * which is used to interact with that table. Models allow you to query 
 * for data in your tables, as well as insert new records into the table.
 * 
 * @version 1.0
 */
class ZahteviModerator extends Model
{
    /**
     * This method returns the App\Mesto which this moderator works at or is based at
     * 
     * @author Stefan Teslic
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function opstinaPoslovanja(){
        return $this->belongsTo('App\Mesto','opstinaPoslovanja_id', 'id');
    }
}
