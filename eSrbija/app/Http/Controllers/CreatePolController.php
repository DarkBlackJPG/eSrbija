<?php

namespace App\Http\Controllers;

use App\Ankete;
use App\Mesto;
use App\Pitanja;
use App\PonudjeniOdgovori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePolController extends Controller
{
    //
    const IZBORI =2 , REFERENDUM=1, OBICNA=0;
    const DOZVOLA_OBICNE=1, DOZVOLA_REFERENDUMI_IZBORI_OBICNE = 2, DOZVOLA_NACIONALNI_I_LOKALNI=2, DOZVOLA_LOKALNI=1;

    public function return_view(){
        $mesta = Mesto::dohvatiSveNaziveMesta(); // ovo vraca objekte klase Mesto
        $nazivi='';
        $count = count($mesta);
        $i=0;
        foreach ($mesta as $value){ //pravi string 'Bg', 'Cacak','Subotica', itd...

          if($i < $count-1){
            $nazivi.= '\''.$value->naziv.'\''.',';}
            else $nazivi.='\''.$value->naziv.'\'';
            $i++;

        }
        $user = auth()->user();
        $dozvola_tip = self::DOZVOLA_REFERENDUMI_IZBORI_OBICNE;
        $dozvola_lokalnosti= self::DOZVOLA_NACIONALNI_I_LOKALNI;
        if(!$user->isAdmin){
            $moderator = $user->moderatori()->first();
            $dozvola_lokalnosti=$moderator->lokalnost;
            $dozvola_tip= $moderator->ankete;
        }

        return view('homepages.ankete.napraviankete',['mesta' => $nazivi,'dozvola_tip'=>$dozvola_tip, 'dozvola_lokalnosti'=> $dozvola_lokalnosti]);
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
            if($this->isEmptyOrNullString( \request('tip'))) $ispravno=false;
            if(\request('nivo')=="lokalni"){
            if($this->isEmptyOrNullString(\request('mesta'))) $ispravno=false;
            }
            $user = auth()->user();
            if(!$user->isAdmin){ //ukoliko je moderator
                $moderator = $user->moderatori()->first();
                if(\request('nivo') =='nacionalni' && $moderator->lokalnost != self::DOZVOLA_NACIONALNI_I_LOKALNI) $ispravno=false;
                if(\request('tip')!="obicna" && $moderator->ankete != self::DOZVOLA_REFERENDUMI_IZBORI_OBICNE ) $ispravno=false;
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

             if (!$ispravno) return redirect(route('ankete'))->with(['poruka'=>'Neuspesno napravljena anketa', 'icon'=>'warning']);;



        }

       //dodaj ako je null
        //ubacivanje u tabelu ankete
        $naziv = \request('naziv');
        $tip= \request('tip');
        if($tip == 'izbori') $tip=self::IZBORI;
        else if ($tip=='referendum') $tip=self::REFERENDUM;
        else if($tip=='obicna') $tip=self::OBICNA;
        $nivoLokNac = \request('nivo') == 'lokalni'? 1 : 0; //Lokalni 1, nacionalni 0
        $anketa= Ankete::napraviAnketu($naziv,$nivoLokNac, $tip);
        //dodati da je required u zavisnosti od popunjenih checkboxova
        //Ako je lokalni, ubacivanje u vezu mesta i ankete
            if($nivoLokNac==1){
                $nizIdmesta=null;
                $nizmesta = explode(',', \request('mesta')[0]);
                $i=0;
                foreach ($nizmesta as $naziv){
                    $mesto=Mesto::dohvatiMestoPoNazivu($naziv);
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
                        $pitanje= Pitanja::napraviPitanje($anketa,$val);

                 }
            else if(Str::is('odgovor*', $key)){
                    PonudjeniOdgovori::napraviOdgovor($pitanje,$val);
            }
        }

   return redirect(route('ankete'))->with(['poruka'=>'Uspesno napravljenja anketa', 'icon'=>'success']);;

    }

        public function delete_poll($id){

          /*  $anketa= Ankete::findOrFail($id);
            $anketa->obrisanoFlag=true;
            $anketa->save();*/
           $anketa =Ankete::findOrFail($id);
           if($anketa->korisnik_id == auth()->user()->id || auth() -> user() ->isAdmin)
          DB::table('anketes')->where(['id' => $id])->update(['obrisanoFlag' => true]);



            return redirect()->route('mojeankete')->with(['poruka'=>'Uspesno obrisana anketa', 'icon'=>'success']);

        }
}
