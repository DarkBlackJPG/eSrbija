<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitanja extends Model
{
    public function anketa() {
        return $this->belongsTo('App\Ankete', 'ankete_id');
    }
}
