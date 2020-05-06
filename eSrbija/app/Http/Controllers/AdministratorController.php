<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\Kategorije;
use App\Korisnik;
use App\Moderator;
use Illuminate\Http\Request;

/**
 * Class AdministratorController - Necessary functions for administrator functioning
 * @package App\Http\Controllers
 * @author Stefan Teslic
 * @version 1.0
 */
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
    /**
     * Generates array of not-yet-approved moderators.
     *
     * If $ajax is true, then this method gets only moderators that the moderator was not
     * notified about ('adminNotified' == 0)
     *
     * @param bool $ajax
     * @return array $moderatorArray
     * @author Stefan Teslic
     */
    private function generateModeratorArray(bool $ajax) {
        $moderators = null;
        if($ajax == true) {
            $moderators = Moderator::where('approved',0)->where('adminNotified', 0)->with(['opstinaPoslovanja','korisnik', 'korisnik.ovlascenja'])->get();
        } else {
            $moderators =  Moderator::where('approved',0)->with(['opstinaPoslovanja','korisnik', 'korisnik.ovlascenja'])->get();
        }

        $ids = $moderators->pluck('id');
        $nazivi = $moderators->pluck('naziv');
        $opstine = $moderators->pluck('opstinaPoslovanja');
        $adrese = $moderators->pluck('adresa');
        $pibovi = $moderators->pluck('pib');
        $maticniBrojevi = $moderators->pluck('maticniBroj');
        $ovlascenja = $moderators->pluck('korisnik.ovlascenja');
        $moderatorArray = [];
        for($i = 0; $i < sizeof($moderators); $i++) {
            if($ajax){
                $moderators[$i]->adminNotified = 1;
                $moderators[$i]->save();
            }
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

        return $moderatorArray;
    }
    /**
     * This method gets all unapproved moderators and all categories.
     * This returns a View with data 'moderatori' and 'kategorije'
     *
     * @uses private function generateModeratorArray(bool $ajax);
     * @return Illuminate\View\View
     * @author Stefan Teslic
     */
    public function getModeratorApprovalForms() {
        $moderatorArray = $this->generateModeratorArray(false);
        $categories = Kategorije::all()->pluck('naziv');
        return view('admin.moderatorApproval', ['moderatori'=>$moderatorArray, 'kategorije' => $categories]);
    }

    public function moderatorApprove(Request $request, Korisnik $id) {
        $mailtoMail = $id->email;
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
        \Mail::to($mailtoMail)->send(new \App\Mail\ModeratorApprove());
        return redirect()->back()->with('successApprove', 'Uspesno ste odobrili '.$moderator->naziv.' sa pravima moderatora!');

    }

    /**
     * This method sends an email to rejected moderator
     * and deletes that moderator's record in DB
     *
     * @param Request $request
     * @param App\Korisnik $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     * @throws \Exception
     * @author Stefan Teslic
     */
    public function moderatorReject(Request $request, Korisnik $id) {
        $mailtoMail = $id->email;
        $moderatorName = $id->moderatori()->first()->naziv;
        $id->delete();
        \Mail::to($mailtoMail)->send(new \App\Mail\ModeratorReject());
        return redirect()->back()->with('successReject', 'Uspesno ste odbili '.$moderatorName.'!');
    }

    /**
     * This method checks if there are any moderators that were
     * created and that were not used to notify the administrator
     * user.
     *
     * @return \Illuminate\Http\Response
     * @author Stefan Teslic
     */
    public function moderatorRequestCheck() {
        $moderators = Moderator::where('approved',0)->where('adminNotified', 0)->update(['adminNotified'=> 1]);

        if($moderators > 0){
            return response()->json(['number' => $moderators]);
        } else {
            return response('nothing', 500);
        }
    }
}
