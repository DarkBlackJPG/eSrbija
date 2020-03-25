<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePolController extends Controller
{
    //

    public function return_view(){
        $mesta = DB::table('mestos')->get();

        return view('homepages.napraviankete',['mesta' => $mesta]);
    }

    public function create_poll (){
       $user=auth()->user();
       //dodaj ako je null
        //ubacivanje u tabelu ankete
        $naziv = \request('naziv');
        $nivoLokNac = \request('nivo') == 'lokalni'? 1 : 0;
        $anketa= $user->mojeAnkete()->create( [
            'naziv'=> $naziv,
            'nivoLokNac' => $nivoLokNac,
            'obrisanoFlag' =>false
        ]);

        // ubacivanje u tabelu pitanja i u isto vreme i u tabelu odgovori
 $pitanje=null;
        foreach (\request()->all() as $key => $val) {
            if($key=='_token') continue;
            if(Str::is('pitanje*', $key)){
                        $pitanje=$anketa->pitanja()->create([
                  'tekst'=> $val
                ]);
                 }
            else if(Str::is('odgovor*', $key)){
                $pitanje->odgovori()->create([
                    'tekst'=> $val
                ]);

            }



        }

        dd(\request()->all());


    }
}
