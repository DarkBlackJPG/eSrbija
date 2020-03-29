<?php

namespace App\Http\Controllers;

use App\Ankete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerPollController extends Controller
{
    public function list_all_polls_created_by_me(){
        $user = auth()->user();
        $ankete = null;
        if($user->isAdmin) {
            $ankete = DB::table('anketes')->where('obrisanoFlag' , false)->orderBy('created_at','DESC')->get();
        } else {
            if($user->isMod) $ankete = $user->mojeAnkete();
                foreach($ankete as $key =>$val){
                    if($val->obrisanoFlag) unset($ankete[$key]);
            }

        }
        return view('homepages.mojeankete',['anketeMoje' =>$ankete]);




    }

    public function close_poll($id){

        $anketa= Ankete::findOrFail($id);
        $anketa->isActive=false;
        $anketa->save();

     return redirect(route('mojeankete'));

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

                 $neprivKor= auth()->user()->neprivilegovaniKorisnici();
                foreach ($neprivKor as $value) $userMesto=$value->opstinaPrebivalista->id;
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
          $ankete = DB::table('anketes')->
               whereRaw("anketes.isActive = 1 and  id not  in
                 ( select a.id
        from anketes a, korisniks, ponudjeni_odgovoris po, pitanjas, odgovori_korisnik
        where a.id=pitanjas.ankete_id and pitanjas.id=po.pitanja_id
        and po.id = odgovori_korisnik.ponudjeni_odgovori_id
         and odgovori_korisnik.korisnik_id = $userid )
         ")->orderBy('created_at', 'DESC')->get();

      /*  foreach($ankete as $key=> $value)  {
            $flag= false;
            foreach ($value->vezanoZaMesto() as $mesto) if($mesto->id==$userMesto) $flag=true;
            if($flag==false) unset($ankete[$key]);

        }*/

        foreach($ankete as $key =>$val)
            if($val->obrisanoFlag) unset($ankete[$key]);

        return view('homepages.aktivneAnkete', ['ankete' => $ankete]);


    }


    public function save_answers($id){
        $user=auth()->user();
        $niz_id_odgovora=null;
        $i=0;
         foreach (\request()->all() as $odg_id){
             if($i==0){$i++; continue;}
                    $niz_id_odgovora[$i]=$odg_id;
                    $i++;
         }
        $user->sviOdgovori()->attach($niz_id_odgovora);
         return redirect(route('ankete'));



    }
}
