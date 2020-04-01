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


        return view('homepages.ankete.napraviankete',['mesta' => $nazivi]);
    }
    public function isEmptyOrNullString($arg) {
        if(empty($arg)) return true;
        if($arg=='') return true;
        return false;
    }
    public function create_poll (){
        { //provera ispravnosti
            $ispravno = true;
            if($this->isEmptyOrNullString( \request('naziv'))) $ispravno=false;
            if($this->isEmptyOrNullString( \request('nivo'))) $ispravno=false;
            if(\request('nivo')=="lokalni"){
            if($this->isEmptyOrNullString(\request('mesta'))) $ispravno=false;
            }
            $biloJednoPitanje=false;
            $pitanjeDoPitanja=false;
            foreach (\request()->all() as $key => $val) {
                            if($key=='_token') continue;
                            if(Str::is('pitanje*', $key)){
                                 $biloJednoPitanje=true;
                                 if ($pitanjeDoPitanja) {$ispravno=false; break;}
                                    else $pitanjeDoPitanja=true;
                                if($this->isEmptyOrNullString($val)) {$ispravno=false; break;}
                                }
                            else if(Str::is('odgovor*', $key)){
                                 $pitanjeDoPitanja=false;
                                 if($this->isEmptyOrNullString($val)) { $ispravno=false; break;}
                                 }
                        }
             if ($biloJednoPitanje==false)$ispravno=false;

             if (!$ispravno) return redirect(route('ankete'));



        }
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
           $anketa =Ankete::findOrFail($id);
           if($anketa->korisnik_id == auth()->user()->id || auth() -> user() ->isAdmin)
          DB::table('anketes')->where(['id' => $id])->update(['obrisanoFlag' => true]);


            return redirect(route('mojeankete'));

        }
}
