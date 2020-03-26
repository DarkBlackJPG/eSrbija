<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZahteviModerator extends Model
{
    public function opstinaPoslovanja(){
        return $this->belongsTo('App\Mesto','opstinaPoslovanja_id', 'id');
    }
}
