<?php

namespace App\Http\Controllers;

use App\Obavestenja;
use App\Kategorije;
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


    public function prikaziMojaObavestenja(){

        $user = auth()->user();
        $obavestenja = null;
        if ( !$user->isMod && !$user->isAdmin ) {
            return redirect()->route("home");
        }
    
        $obavestenja = Obavestenja::where(['korisnik_id' => $user->id, 'obrisanoFlag' => false])->paginate(5);
     
    
        
        return view('homepages.mojaObavestenja',['mojaObavestenja' => $obavestenja]);



    }

    public function prikaziObavesenjaZaKategoriju($id){//Greske ako je null nesto, pogledati i obezbediti se od toga
        //Prebaciti sve ovo u model, da ne bude u kontroleru
       
        $kategorija = Kategorije::where("id", '=' , $id)->first();
        $obavestenja = $kategorija->obavestenja()->where('obrisanoFlag', false)->paginate(5);
      /*  $obavestenjaForMe = [];
        foreach ($obavestenja as $obavestenje){
            if($obavestenje->nivoLokNac == 1){
                $obavestenjaForMe[] = $obavestenje;
            } else {
                //Sta prikazati adminu, sve ili nema tu opciju
                $mesta = $obavestenje->vezanoZaMesto();
                $idMesto = null;
                if( auth()->user()->isMod){
                    $idMesto = Modderator::find(auth()->user()->id)->first();
                } else{
                    $idMesto = NeprivilegovaniKorisnik::find(auth()->user()->id())->first();
                }

                if( in_array($idMesto, $mesta) ){
                    $obavestenjaForMe[]= $obavestenje;
                }
            }
        }
        


        Treba dodati jos da iznbacim obavestenja koja nisu lokalna, odnosno nr peipadaju mestu korisnika
        */
        return view("homepages.obavestenja_po_kategorijama", ['mojaObavestenja' => $obavestenja, "imeKategorije" => $kategorija->naziv]);

    }

}
