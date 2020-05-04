<?php

namespace App\Http\Controllers;

use App\Ankete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerPollController extends Controller
{
    public function list_all_polls_created_by_me($poruka=null,$icon=null){
        $user = auth()->user();
        $ankete = null;
        if($user->isAdmin) {
            $ankete = Ankete::dohvatiSveAnkete();
        } else {
            if($user->isMod){
                $ankete = Ankete::dohvatiSveModeratoroveAnkete();
                if($ankete != null && count($ankete)>0)
                foreach($ankete as $key =>$val){
                    if($val->obrisanoFlag) unset($ankete[$key]);
            }}

        }
        $niz = ['anketeMoje' =>$ankete];
//        if(isset($poruka)) {
//            $niz['poruka']=$poruka;
//            $niz['icon']=$icon;
//        }

        return view('homepages.mojeankete',$niz);




    }

    public function close_poll($id){


        $anketa= Ankete::findOrFail($id);
        if($anketa -> korisnik_id == auth()->user()->id || auth()->user()->isAdmin) {
            $anketa->isActive = false;
            $anketa->save();
        }
        unset(\request()->all()['id']);

    return redirect(route('mojeankete'))->with(['poruka'=>'Uspesno zatvorena anketa', 'icon'=>'success']);;

    }







    public function answer_poll($id)
    {
        $anketa = Ankete::findOrFail($id);

        return view('homepages.ankete.popunianketu', ['anketa' => $anketa]);

    }

    public function list_active()
    {
            $userid=auth()->user()->id;
            $nijeObicanKorisnik=true;
        $userMesto=1;
           if(!auth()->user()->isAdmin && !auth()->user()->isMod ) {
                $nijeObicanKorisnik=false;

                 $neprivKor= auth()->user()->neprivilegovaniKorisnici()->first();
                 $userMesto=$neprivKor->opstinaPrebivalista->id;

           }




//        DB::raw('
//        select anketes.* from anketes where anketes.id not in
//        ( select anketes.id
//        from anketes, korisniks, odgovoris, pitanjas, odgvori_korisnik
//        where anketes.id=pitanjas.ankete_id and pitanjas.id=odgovoris.pitanja_id
//        and odgovoris.id = odgovori_korisnik.odgovori_id
//         and odgovori_korisnik.korisnik_id = $userid )'
//        )
    // dohvaata sve aktivne i neodgovorene ankete
          $ankete = Ankete::dohvatiSveAktivneINeodgovoreneAnkete($userid);
        if($nijeObicanKorisnik==false)
       foreach($ankete as$key=> $value)  {
           if($value->nivoLokNac == 1) { //lokalni = 1 , nacionalni = 0;
               $flag = true;
               $mesto = Ankete::dohvatiVezuAnketeMesto($userMesto,$value);
               if (empty($mesto) || count($mesto)==0) $flag = false;
               //foreach ($value->vezanoZaMesto as $key=> $mesto) if($mesto->id==$userMesto) $flag=true;
               if ($flag == false) unset($ankete[$key]);
           }
        }

        foreach($ankete as $key =>$val)
            if($val->obrisanoFlag) unset($ankete[$key]);

         $niz= ['ankete'=> $ankete];

        return view('homepages.aktivneAnkete',$niz);


    }


    public function save_answers($id){
         // provera ispravnosti
        $lista_odgovora_postojecih_u_bazi=[];
        {
            $anketa = Ankete::findOrFail($id);
            $ispravno = true;
            $i=1;

            foreach ($anketa->pitanja as $pitanje) {

                if(empty(\request($pitanje->id))) {
                    echo 'usao ovde';
                    return redirect(route('ankete'))->with(['poruka'=>'Neuspesno odgovoreno na anketu', 'icon'=>'warning']);;
                } else {

                    $lista_odgovora_postojecih_u_bazi[$i] = \request($pitanje->id);
                    $i++;

                }

                /*$odgovoreno = false;
                foreach ($pitanje->odgovori as $odgovor) {
                   if (in_array("$odgovor->id", \request()->all())) {
                        if (!$odgovoreno) {
                            $odgovoreno = true;
                            dd('usao 2');
                            $lista_odgovora_postojecih_u_bazi[$i]=$odgovor->id;
                            $i++;
                        }
                        else {
                            $ispravno = false;
                            return redirect(route('ankete'));
                        }
                    }
                    if (!$odgovoreno) {
                        $ispravno = false;
                        return redirect(route('ankete'));
                    }
                }*/
            }
        }
        $user=auth()->user();
        $niz_id_odgovora=null;
        $i=0;
         foreach (\request()->all() as $odg_id){
             if($i==0){$i++; continue;}
                    $niz_id_odgovora[$i]=$odg_id;
                    $i++;
         }

         if($niz_id_odgovora == $lista_odgovora_postojecih_u_bazi) {

             $user->sviOdgovori()->attach($niz_id_odgovora);
         }
         return redirect(route('ankete'))->with(['poruka'=>'Uspesno odgovoreno na anketu', 'icon'=>'success']);;



    }
}
