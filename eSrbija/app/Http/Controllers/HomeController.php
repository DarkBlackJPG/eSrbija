<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Kategorije;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function glavnaStranica() {
        $kategorijaVazno = Kategorije::where("naziv", "=", "VAZNO")->firstOrFail();
        $vaznaObavestenja = $kategorijaVazno->obavestenja()->getResults();
        
        return view('homepages.obavestenja', ['vaznaObavestenja' => $vaznaObavestenja]);
    }

    /**
     * Prijava na izabranu kategoriju obavestenja.
     * 
     * @author Luka Spehar
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request) {
        dd('asdf');
        $user = auth()->user();
        $kategorija = Kategorije::findOrFail(request('kategorijaId'));
        $kategorija->pretplaceni()->attach($user->id);

        return response()->json(['status' => 'success']);
    }

    /**
     * Odjava sa izabrane kategorije obavestenja.
     * 
     * @author Luka Spehar
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request) {
        $user = auth()->user();
        $kategorija = Kategorije::findOrFail(request('kategorijaId'));
        $kategorija->pretplaceni()->detach($user->id);

        return response()->json(['status' => 'success']);
    }
}
