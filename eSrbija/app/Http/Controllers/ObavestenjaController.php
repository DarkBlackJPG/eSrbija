<?php

namespace App\Http\Controllers;

use App\Obavestenja;
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
        if($user->isMod){
             $obavestenja = Obavestenja::where('korisnik_id',1)->get();
          
        }
      

          
        return view('homepages.mojaObavestenja',['mojaObavestenja' => $obavestenja]);



    }
}
