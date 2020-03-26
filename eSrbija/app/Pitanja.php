<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitanja extends Model
{
    protected $fillable=['tekst'];
    public function anketa() {
        return $this->belongsTo('App\Ankete', 'ankete_id');
    }
    public function odgovori() {
        return $this->hasMany('App\PonudjeniOdgovori', 'pitanja_id', 'id');
    }
}
