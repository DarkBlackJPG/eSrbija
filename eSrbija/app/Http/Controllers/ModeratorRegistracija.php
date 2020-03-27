<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Mesto;
use App\Moderator;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class ModeratorRegistracija extends Controller
{
    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        $kategorije = $request->kategorije;
        $kategorije = explode(",", $kategorije);

        $request->validate([
            'naziv' => [
                'required',
                'string',
                'max:255',
                'unique:moderators,naziv',
            ],
            'email' => [
              'required',
                'email',
                'max:255',
                'unique:korisniks,e-mail'
            ],
            'opstina' => [
                'required',
                'string',
                'max:255',
                'exists:mestos,naziv'
            ],
            'adresa' => [
                'required',
                'string',
                'max:255',
            ],
            // TODO Koliko pib ima brojeva
            'pib' => [
                'required',
                'string',
                'unique:moderators,pib',
            ],
            // TODO Koliko matbr ima brojeva
            'matBr' => [
                'required',
                'string',
                'unique:moderators,maticniBroj',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[0-9]/i',
                'required_with:password_confirmation',
                'same:password_confirmation'
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[0-9]/i',
            ],
        ]);
        $categoryIds = [];
        foreach ($kategorije as $kategorija) {
            $category = \App\Kategorije::where('naziv', '=', $kategorija)->first();
            // Mora provera da je null u slucaju da je neko menjao naziv #hakeri
            if($category != null){
                array_push($categoryIds, $category->id);
            }
        }

        $user = new Korisnik();
        $user->{"e-mail"} = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->isMod = true;
        $user->isAdmin = false;
        $user->save();

        $data = $request;

        $moderator = new Moderator();
        $moderator->id = $user->id;
        $moderator->naziv = $data['naziv'];
        $moderator->adresa = $data['adresa'];
        $moderator->pib = $data['pib'];
        $moderator->maticniBroj = $data['matBr'];
        $moderator->opstinaPoslovanja_id = Mesto::where('naziv', '=', $data['opstina'])->first()->id;
        $moderator->save();

        foreach ($categoryIds as $categoryId) {
            $user->ovlascenja()->attach($categoryId);
        }

        return redirect('/')->with('successModReg',
            'Uspesno ste poslali zahtev za registrovanje');
    }

}
