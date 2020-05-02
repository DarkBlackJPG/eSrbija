<?php

namespace App\Http\Controllers;

use App\Obavestenja;
use App\Kategorije;
use App\Moderator;
use App\NeprivilegovanKorisnik;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if( $user->isAdmin ) {
            $obavestenja = Obavestenja::paginate(4);
        } else {
            $obavestenja = Obavestenja::svaObavestenjaModeratora($user->id);
        }
        return view('homepages.mojaObavestenja',['mojaObavestenja' => $obavestenja]);

    }

   /**
    *Prikaz obavestenja za kategoriju, nacionalnih i lokalnih za korisnika za dati id
    *U slucaju da je korisnik admin, prikaz svih obavestenja za datu kategoriju za dati id
    * @author Dušan Stijović
    * @param int $id
    * @return view
    */
    public function prikaziObavesenjaZaKategoriju(int$id){//Greske ako je null nesto, pogledati i obezbediti se od toga
        $kategorija = Kategorije::where("id", '=' , $id)->first();

        if( auth()->user()->isAdmin ){
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

}
