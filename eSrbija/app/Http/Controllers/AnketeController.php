<?php

namespace App\Http\Controllers;

use App\Ankete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Sluzi za obradu zahteva koji se odnosi na prikaz statistike anketama u sistemu
 * 
 * @version 1.0
 */
class AnketeController extends Controller
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
     * @param  \App\Ankete  $ankete
     * @return \Illuminate\Http\Response
     */
    public function show(Ankete $ankete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ankete  $ankete
     * @return \Illuminate\Http\Response
     */
    public function edit(Ankete $ankete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ankete  $ankete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ankete $ankete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ankete  $ankete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ankete $ankete)
    {
        //
    }


    /**
    *Prikaz statistkike za anketu sa datim id-ijem
    * @author Dušan Stijović
    * @param int $id
    * @return view
    */
    public function statistikaAnkete($id){
        $user = auth()->user();
        if(!$user->isMod && !$user->isAdmin){
              return redirect()->route("home");
        }
        $pitanjaSaBrojemOdgovora = Ankete::pitanjaAnketeSaBrojemOdgovoraPoPitanju($id);

        if(!$pitanjaSaBrojemOdgovora["isAnswered"]){
               return redirect()->back()->with("info", "Za izabranu anketu nema statistike!");
        } else{
            return view("homepages.statistikaanketa", ["pitanja"=>$pitanjaSaBrojemOdgovora["pitanja"], "brojOdgovora"=>$pitanjaSaBrojemOdgovora["brojOdgovora"]]);
        }
   
    }
}
