<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Kategorije;
use \App\Obavestenja;
use \Illuminate\Support\Collection;

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

    /**
     * Prikazuje glavnu stranicu za ulogovane korisnike.
     * 
     * @author Filip Carevic, Luka Spehar
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function glavnaStranica() {
        $kategorijaVazno = Kategorije::where(['naziv' => 'VAZNO'])->firstOrFail();
        $vaznaObavestenja = $kategorijaVazno->obavestenja()->latest()->getResults();
        foreach($vaznaObavestenja as $key => $value) {
            if($vaznaObavestenja[$key]->obrisanoFlag){
                $vaznaObavestenja->forget($key);
            }
        }

        $obavestenjaIds = \DB::table('kategorije_obavestenjas')->select('obavestenja_id')->where('kategorije_id', '!=', $kategorijaVazno->id)->distinct()->pluck('obavestenja_id');
        $ostalaObavestenja = Obavestenja::orderBy('created_at', 'desc')->whereIn('id', $obavestenjaIds)->where('obrisanoFlag', false)->paginate(4);
        
        return view('homepages.obavestenja', [
            'vaznaObavestenja' => $vaznaObavestenja,
            'ostalaObavestenja' => $ostalaObavestenja,
            'search' => false
        ]);
    }

    /**
     * Pretraga obavestenja po naslovu.
     * 
     * @author Luka Spehar
     * @return void
     */
    public function search() {
        request()->flash();
        $searchFor = request('naslov') ?? request()->query('naslov');
        $obavestenja = null;
        if($searchFor != "") {
            $obavestenja = Obavestenja::where('naslov', 'LIKE', '%'.$searchFor.'%')->where('obrisanoFlag', false)->paginate(4);
            $obavestenja->appends(['naslov' => $searchFor]);
        }

        return view('homepages.rezultatiPretrageObavestenja', ['obavestenja' => $obavestenja]);
    }

    /**
     * Prijava na izabranu kategoriju obavestenja.
     *
     * @author Luka Spehar
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request) {
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
