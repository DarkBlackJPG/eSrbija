<?php

namespace App\Http\Controllers;

use App\Ankete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePolController extends Controller
{
    //

    public function return_view(){
        $mesta = DB::table('mestos')->get('naziv'); // ovo vraca objekte klase Mesto
        $nazivi='';
        $count = count($mesta);
        $i=0;
        foreach ($mesta as $value){ //pravi string 'Bg', 'Cacak','Subotica', itd...

          if($i < $count-1){
            $nazivi.= '\''.$value->naziv.'\''.',';}
            else $nazivi.='\''.$value->naziv.'\'';
            $i++;

        }


        return view('homepages.napraviankete',['mesta' => $nazivi]);
    }

    public function create_poll (){

       $user=auth()->user();
       //dodaj ako je null
        //ubacivanje u tabelu ankete
        $naziv = \request('naziv');
        $nivoLokNac = \request('nivo') == 'lokalni'? 1 : 0; //Lokalni 1, nacionalni 0
        $anketa= $user->mojeAnkete()->create( [
            'naziv'=> $naziv,
            'nivoLokNac' => $nivoLokNac,
            'obrisanoFlag' =>false,
            'isActive'=>true
        ]);
        //dodati da je required u zavisnosti od popunjenih checkboxova
        //Ako je lokalni, ubacivanje u vezu mesta i ankete
            if($nivoLokNac==1){
                $nizIdmesta=null;
                $nizmesta = explode(',', \request('mesta')[0]);
                $i=0;
                foreach ($nizmesta as $naziv){
                    $mesto=DB::table('mestos')->where('naziv',$naziv)->first();
                    $nizIdmesta[$i]=$mesto->id;
                    $i++;
                }
                $anketa->vezanoZaMesto()->attach($nizIdmesta);



            }



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

   return redirect(route('ankete'));

    }

        public function delete_poll($id){

          /*  $anketa= Ankete::findOrFail($id);
            $anketa->obrisanoFlag=true;
            $anketa->save();*/

          DB::table('anketes')->where(['id' => $id])->update(['obrisanoFlag' => true]);


            return redirect(route('mojeankete'));

        }
}
