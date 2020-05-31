<?php

namespace App\Http\Controllers;

use App\Ankete;
use App\NeprivilegovanKorisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AnswerPollController
 * @package App\Http\Controllers
 * @version 1.0
 * Sluzi za obradu zahteva vezanih za izlistavanje anketa, referenduma i izbora, popunjavanje i zatvaranje istih
 */

class AnswerPollController extends Controller
{
    const IZBORI =2;
    const REFERENDUM=1;
    const OBICNA=0;
    const PAGINATION_OFFSET=4;

    /**
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Filip Carevic
     *
     * lista sve neobrisane ankete koje je korisnik napravio ukoliko je moderator, ukoliko je admin lista sve neobrisane
     */
    public function list_all_polls_created_by_me($page=0){
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

        if(empty($page) || $page<0 ){
            $page=0;
        }
           $hasmore=false;
        if($ankete!=null) {
            $hasmore = $page * self::PAGINATION_OFFSET + self::PAGINATION_OFFSET < count($ankete);
            $ankete = $ankete->splice($page * self::PAGINATION_OFFSET, self::PAGINATION_OFFSET);
        }
        $niz= ['anketeMoje'=> $ankete,
            'page' =>$page,
            'hasMore' => $hasmore,
         ];



        return view('homepages.mojeankete',$niz);




    }

    /**
     * zatvara anketu sa datim id-m ukoliko ju je korisnik napravio, ili je korisnik administrator
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *@author Filip Carevic
     *
     */
    public function close_poll($id){


        $anketa= Ankete::findOrFail($id);
        if($anketa -> korisnik_id == auth()->user()->id || auth()->user()->isAdmin) {
            $anketa->isActive = false;
            $anketa->save();
        }
        unset(\request()->all()['id']);

    return redirect(route('mojeankete'))->with(['poruka'=>'Uspesno zatvorena anketa', 'icon'=>'success']);;

    }


    /**
     * pravi formu za popunjavanje za anketu sa zadatim id-em
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     *
     * @author Filip Carevic
     */


    public function answer_poll($id)
    {
        $anketa = Ankete::findOrFail($id);
        $ispravno=false;
        $user = auth()->user();
        $isMod = $user->isMod && !$user->isAdmin;
        $obicanKorisnik = !$user->isMod && !$user->isAdmin;
        if($anketa->nivoLokNac===1) {
            $mesto = null;
            if ($isMod) {
                $mod = $user->moderatori()->first();
                $mesto = $mod->opstinaPoslovanja();}
            else if ($obicanKorisnik){
             $neprKor = $user->neprivilegovaniKorisnik()->first();
            $mesto = $neprKor->opstinaPrebivalista();
            }
            if ($isMod || $obicanKorisnik) {
                foreach ($anketa->vezanoZaMesto() as $mestoA) {
                    if ($mestoA === $mesto) {
                        $ispravno = true;
                        break;
                    }
                }
                if (!$ispravno)
                    return redirect(route('ankete'))->with(['poruka' => 'Nemate pravo pristupa', 'icon' => 'warning']);;

            }
        }

        return view('homepages.ankete.popunianketu', ['anketa' => $anketa]);

    }


    /**
     *
     * lista sve aktivne i neodgovorene ankete. Ankete lokalnog nivoa prikazuje samo u slucaju da se korisnikovo mesto prebivaista
     * (moderatorovo mesto poslovanja) nalazi u listi mesta za koje se anketa vezuje. Ukoliko je korisnik admin, lista sve aktivne i neodgovorene
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * * @author Filip Carevic
     *
     *
     */
    public function list_active($page=0)
    {
            $userid=auth()->user()->id;
            $nijeObicanKorisnik=true;
        $userMesto=1;
           if(!auth()->user()->isAdmin ) {
                $nijeObicanKorisnik=false;

                if(auth()->user()->isMod){
                    $mod = auth()->user()->moderatori()->first();
                    $userMesto = $mod->opstinaPoslovanja()->first()->id;

                }else {
                    $neprivKor = auth()->user()->neprivilegovaniKorisnik()->first();
                    $userMesto = $neprivKor->opstinaPrebivalista->id;
                }
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


         if(empty($page) || $page<0 ){
                $page=0;
         }

        $hasmore=$page*self::PAGINATION_OFFSET + self::PAGINATION_OFFSET < count($ankete);
        $ankete= $ankete->splice($page*self::PAGINATION_OFFSET, self::PAGINATION_OFFSET);

         $niz= ['ankete'=> $ankete,
                'page' =>$page,
                'hasMore' => $hasmore,
                'route' => 'ankete'
             ];


        return view('homepages.aktivneAnkete',$niz);


    }

    /**
     * belezi odgovore u bazi za anketu sa zadatim id-em za ulogovanog korisnika
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @author Filip Carevic
     *
     */


    public function save_answers($id){
         // provera ispravnosti
        $lista_odgovora_postojecih_u_bazi=[];
        {
            $anketa = Ankete::findOrFail($id);
            $i=1;

            $ispravno=false;
            $user = auth()->user();
            $isMod = $user->isMod && !$user->isAdmin;
            $obicanKorisnik = !$user->isMod && !$user->isAdmin;
            if($anketa->nivoLokNac===1) {
                $mesto = null;
                if ($isMod) {
                    $mod = $user->moderatori()->first();
                    $mesto = $mod->opstinaPoslovanja();}
                else if ($obicanKorisnik){
                    $neprKor = $user->neprivilegovaniKorisnik()->first();
                    $mesto = $neprKor->opstinaPrebivalista();
                }
                if ($isMod || $obicanKorisnik) {
                    foreach ($anketa->vezanoZaMesto() as $mestoA) {
                        if ($mestoA === $mesto) {
                            $ispravno = true;
                            break;
                        }
                    }

                    if (!$ispravno)
                        return redirect(route('ankete'))->with(['poruka' => 'Neuspesno odgovoreno na anketu', 'icon' => 'warning']);;

                }
            }
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

    /**
     * lista aktivne i neodgovorene izbore.Ankete lokalnog nivoa prikazuje samo u slucaju da se korisnikovo mesto prebivaista
     * (moderatorovo mesto poslovanja) nalazi u listi mesta za koje se anketa vezuje. Ukoliko je korisnik admin, lista sve aktivne i neodgovorene
     *
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Filip Carevic
     */


    public function  list_active_elections($page=0){
        $user = auth()->user();

        $nijeObicanKorisnik=true;
        $userMesto=1;
        if(!auth()->user()->isAdmin ) {
            $nijeObicanKorisnik=false;

            if(auth()->user()->isMod){
                $mod = auth()->user()->moderatori()->first();
                $userMesto = $mod->opstinaPoslovanja()->first()->id;

            }else {
                $neprivKor = auth()->user()->neprivilegovaniKorisnik()->first();
                $userMesto = $neprivKor->opstinaPrebivalista->id;
            }
        }
        $ankete = Ankete::dohvatiAktivneINeodgovorenePoTipu(self::IZBORI, $user->id);

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

        if(empty($page) || $page<0 ){
            $page=0;
        }

        $hasmore=$page*self::PAGINATION_OFFSET + self::PAGINATION_OFFSET < count($ankete);
        $ankete= $ankete->splice($page*self::PAGINATION_OFFSET, self::PAGINATION_OFFSET);

        $niz= ['ankete'=> $ankete,
            'page' =>$page,
            'hasMore' => $hasmore,
            'route' => 'izbori',
            'tipAnkete'=> 'izbora'
        ];




        return view('homepages.aktivneAnkete',$niz);
    }

    /**
     * lista aktivne i neodgovorene referendume.Ankete lokalnog nivoa prikazuje samo u slucaju da se korisnikovo mesto prebivaista
     * (moderatorovo mesto poslovanja) nalazi u listi mesta za koje se anketa vezuje. Ukoliko je korisnik admin, lista sve aktivne i neodgovorene
     *
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Filip Carevic
     */
    public function  list_active_referendum($page=0){
        $user = auth()->user();

        $nijeObicanKorisnik=true;
        $userMesto=1;
        if(!auth()->user()->isAdmin ) {
            $nijeObicanKorisnik=false;

            if(auth()->user()->isMod){
                $mod = auth()->user()->moderatori()->first();
                $userMesto = $mod->opstinaPoslovanja()->first()->id;

            }else {
                $neprivKor = auth()->user()->neprivilegovaniKorisnik()->first();
                $userMesto = $neprivKor->opstinaPrebivalista->id;
            }
        }
        $ankete = Ankete::dohvatiAktivneINeodgovorenePoTipu(self::REFERENDUM, $user->id);

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
        if(empty($page) || $page<0 ){
            $page=0;
        }

        $hasmore=$page*self::PAGINATION_OFFSET + self::PAGINATION_OFFSET < count($ankete);
        $ankete= $ankete->splice($page*self::PAGINATION_OFFSET, self::PAGINATION_OFFSET);

        $niz= ['ankete'=> $ankete,
            'page' =>$page,
            'hasMore' => $hasmore,
            'route' => 'referendumi',
            'tipAnkete'=> 'referenduma'
        ];



        return view('homepages.aktivneAnkete',$niz);
    }
}
