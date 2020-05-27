<?php

namespace App\Http\Controllers;

use App\Mesto;
use App\Obavestenja;
use App\Kategorije;
use App\Moderator;
use App\NeprivilegovanKorisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\SubscriptionNotification;


/**
 * Sluzi za obradu zahteva koji se odnose na obavestenja koja se nalaze u sistemu.
 *
 * @version 1.0
 *
 */
class ObavestenjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Prikazuje formu za kreiranje novog obavestenja.
     * @author Luka Spehar
     *
     */
    public function create()
    {
        $mesta = Mesto::dohvatiSveNaziveMesta(); // vraca objekte klase Mesto
        $nazivi = '';
        $count = count($mesta);
        $i=0;
        foreach ($mesta as $value) { //pravi string 'Beograd', 'Cacak','Subotica', itd...
            if($i < $count-1){
                $nazivi.= '\''.$value->naziv.'\''.',';}
            else
                $nazivi.='\''.$value->naziv.'\'';
            $i++;
        }
        $user = auth()->user();

        $sve_kategorije= Kategorije::Dohvati_nazive_svih_kategorija();
        $nazivi_kategorija="";
        $count = count($sve_kategorije);
        $i=0;
        foreach ($sve_kategorije as $value) { //pravi string 'Vazno', 'Finansije', itd...
            if($i < $count-1) {
                $nazivi_kategorija.= '\''.$value->naziv.'\''.',';}
            else 
                $nazivi_kategorija.='\''.$value->naziv.'\'';
            $i++;
        }

        $dozvole='';
        if($user->isAdmin)
            $dozvole = $nazivi_kategorija;
        else {
            $count = count($user->ovlascenja()->getResults());
            $i=0;
            foreach ($user->ovlascenja()->getResults() as $val) {
                if($i<$count-1)
                    $dozvole.='\''. $val->naziv . '\',';
                else
                    $dozvole.='\''. $val->naziv . '\'';
                $i++;
            }
        }
        
        return view('homepages.createpost',['mesta' => $nazivi, 'kategorije'=>$nazivi_kategorija, 'dozvole'=> $dozvole] );
    }

    /**
     * Snima novo obavestenje.
     * @author Luka Spehar
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'kategorije' => 'required',
            'mesta' => 'required'
        ]);
        
        $dozvole = explode(",", request('dozvole'));
        $kategorije = explode(",", request('kategorije'));
        $mesta = explode(",", request('mesta'));
        $valid = true;

        foreach($kategorije as $kategorija) {
            if(!in_array($kategorija, $dozvole))
                $valid = false;
        }
        if(!$valid) {
            return redirect('/home')->with('dozvole', 'Nemate dozvolu da postavljate obaveštenja u sve izabrane kategorije!');
        }
        
        $kategorije_ids = \DB::table('kategorijes')->select('id')->whereIn('naziv', $kategorije)->pluck('id');

        $mesta_ids = null;
        if($mesta[0] != 'none') {
            $mesta_ids = \DB::table('mestos')->select('id')->whereIn('naziv', $kategorije)->pluck('id');
        }

        $usersToNotify = \DB::table('kategorije_pretplates')->select('korisnik_id')->whereIn('kategorije_id', $kategorije_ids)->get();

        $obavestenje = Obavestenja::create([
            'naslov' => request('title'),
            'opis' => request('description'),
            'link' => request('link'),
            'nivoLokNac' => request('nivo'),
            'korisnik_id' => auth()->user()->id,
            'obrisanoFlag' => false
        ]);

        $obavestenje->pripadaKategorijama()->attach($kategorije_ids);
        if($mesta[0] != "none") {
            $obavestenje->vezanoZaMesto()->attach($mesta_ids);
        }

        //slanje mejlova
        $mestaObavestenja = $obavestenje->vezanoZaMesto()->getResults();
        foreach($usersToNotify as $korisnik) {
            $send = true;
            //ako je obavestenje lokalno proveriti da li ga treba poslati trenutnom korisniku
            if(request('nivo') == 1) {
                $mestoPrebivalista = $korisnik->neprivilegovaniKorisnik()->getResults()->mestoPrebivalista()->getResults();
                if(!$mestaObavestenja->contains('id', $mestoPrebivalista->id)) {
                    $send = false;
                }
            }

            if($send) {
                Mail::to($korisnik->email)->send(new SubscriptionNotification($obavestenje));
            }
        } 

        return redirect('/home')->with('obavestenje', 'Obaveštenje uspešno kreirano!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Obavestenja  $obavestenja
     * @return \Illuminate\Http\Response
     */
    public function show(Obavestenja $obavestenja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Obavestenja  $obavestenja
     * @return \Illuminate\Http\Response
     */
    public function edit(Obavestenja $obavestenja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Obavestenja  $obavestenja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obavestenja $obavestenja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Obavestenja  $obavestenja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obavestenja $obavestenja)
    {
        //
    }


    /**
    *Prikaz svih obavestenja koja je napravio moderator
    *U slucaju da je korisnik admin, prikaz svih obavestenja u sistemu
    * @author Dušan Stijović
    * @return view
    */
    public function prikaziMojaObavestenja(){

        $user = auth()->user();

        $obavestenja = null;
        if ( !$user->isMod && !$user->isAdmin ) {
            return redirect()->route("home");
        }
        if( $user->isAdmin && $user->isMod ) {
            $obavestenja = Obavestenja::where(['obrisanoFlag' => false])->paginate(4);
        } else {
            $obavestenja = Obavestenja::svaObavestenjaModeratora($user->id);
        }
        return view('homepages.mojaObavestenja',['mojaObavestenja' => $obavestenja, "isAdmin" => $user->isAdmin]);

    }

   /**
    *Prikaz obavestenja za kategoriju, nacionalnih i lokalnih za korisnika za dati id
    *U slucaju da je korisnik admin, prikaz svih obavestenja za datu kategoriju za dati id
    * @author Dušan Stijović
    * @param int $id
    * @return view
    */
    public function prikaziObavesenjaZaKategoriju($id){
        $kategorija = Kategorije::where("id", '=' , $id)->first();

        if( auth()->user()->isAdmin &&  auth()->user()->isMod ){
            $obavestenja = $kategorija->obavestenja()->where('obrisanoFlag', false)->paginate(4);
        }
        else {
                if( auth()->user()->isMod){
                    $idMesto = Moderator::find(auth()->user()->id)->first()->opstinaPoslovanja_id;
                }
                else{
                    $idMesto = NeprivilegovanKorisnik::find(auth()->user()->id)->first()->opstinaPrebivalista_id;
                }
                $obavestenja = Obavestenja::svaObavestenjaZaKategorijuIMestoKorisnika($id, $idMesto);
        }

        return view("homepages.obavestenja_po_kategorijama", ['mojaObavestenja' => $obavestenja, "imeKategorije" => $kategorija->naziv]);
    }

    public function obrisiObavestenje($id){

        if(!auth()->user()->isMod && !auth()->user()->isAdmin) return;

            $obavestenje = Obavestenja::find($id);
            $obavestenje->obrisanoFlag = true;
            $obavestenje->save();

        return redirect()->back()->with("info", "Obavestenje uspesno obrisano");

    }
}
