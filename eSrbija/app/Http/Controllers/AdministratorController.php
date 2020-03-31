<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\Kategorije;
use App\Korisnik;
use App\Moderator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
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
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrator $administrator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        //
    }

    public function getModeratorApprovalForms() {
        $moderators =  Moderator::where('approved',0)->with(['opstinaPoslovanja','korisnik', 'korisnik.ovlascenja'])->get();
        $ids = $moderators->pluck('id');
        $nazivi = $moderators->pluck('naziv');
        $opstine = $moderators->pluck('opstinaPoslovanja');
        $adrese = $moderators->pluck('adresa');
        $pibovi = $moderators->pluck('pib');
        $maticniBrojevi = $moderators->pluck('maticniBroj');
        $ovlascenja = $moderators->pluck('korisnik.ovlascenja');
        $moderatorArray = [];
        for($i = 0; $i < sizeof($moderators); $i++) {
            $id = $ids[$i];
            $naziv = $nazivi[$i];
            $opstina = $opstine[$i]->naziv;
            $adresa = $adrese[$i];
            $pib = $pibovi[$i];
            $maticniBroj = $maticniBrojevi[$i];
            $ovlascenje = $ovlascenja[$i];
            $moderatorArray[$i] = [
                'id' => $id,
                'naziv' => $naziv,
                'adresa' => $adresa,
                'opstina' => $opstina,
                'pib' => $pib,
                'maticniBroj' =>$maticniBroj,
                'ovlascenja' => $ovlascenje,
            ];
        }
        $categories = Kategorije::all()->pluck('naziv');
        return view('admin.moderatorApproval', ['moderatori'=>$moderatorArray, 'kategorije' => $categories]);
    }

    public function moderatorApprove(Request $request, Korisnik $id) {
        $mailtoMail = $id->email;
        \Mail::to($mailtoMail)->send(new \App\Mail\ModeratorApprove());
        $kategorije = $request->opstina;

        $kategorije = explode(",", $kategorije);
        $categoryIds = [];
        foreach ($kategorije as $kategorija) {
            $category = \App\Kategorije::where('naziv', '=', $kategorija)->first();
            if($category != null){
                array_push($categoryIds, $category->id);
            }
        }
        $id->ovlascenja()->sync($categoryIds);
        $moderator = $id->moderatori()->first();
        $moderator->approved = 1;
        $moderator->save();
        return redirect()->back()->with('successApprove', 'Uspesno ste odobrili '.$moderator->naziv.' sa pravima moderatora!');

    }
    public function moderatorReject(Request $request, Korisnik $id) {
        $mailtoMail = $id->email;
        $moderatorName = $id->moderatori()->first()->naziv;
        \Mail::to($mailtoMail)->send(new \App\Mail\ModeratorReject());
        $id->delete();

        return redirect()->back()->with('successReject', 'Uspesno ste odbili '.$moderatorName.'!');
    }

}
