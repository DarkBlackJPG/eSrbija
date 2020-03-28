<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Mesto;
use App\NeprivilegovanKorisnik;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NeprivilegovanKorisnikRegistracija extends Controller
{
    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function register(Request $request)
    {
        // Imam neki bag, nece da tadi TODO: Resiti ovaj bag ovde da validira kako treba
        $request->validate([
            'ime' => [
                'required',
                'string',
                'max:255'
            ],
            'prezime' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => ['required',
                'email',
                'max:255',
                'unique:korisniks,e-mail'
            ],
            'rodjendan' => [
                'required',
                'date',
                'max:255'
            ],
            'prebivaliste' => [
                'required',
                'string',
                'max:255',
                'exists:mestos,naziv'
            ],
            'adresaPrebivalista' => [
                'required',
                'string',
                'max:255'
            ],
            'JMBG' => [
                'required',
                'string',
                'max:13',
                'unique:neprivilegovan_korisniks,jmbg'
            ],
            'pol' => [
                'required',
                'boolean'
            ],
            'rodjenje' => [
                'required',
                'string',
                'exists:mestos,naziv'
            ],
            'brojLicne' => [
                'required',
                'string',
                'max:9',
                'unique:neprivilegovan_korisniks,brojLicneKarte'
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

        $user = new Korisnik();
        $user->{"e-mail"} = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->isMod = false;
        $user->isAdmin = false;
        $user->save();

        $data = $request;

        $unprivUser = new NeprivilegovanKorisnik();
        $unprivUser->id = $user->id;
        $unprivUser->ime = $data['ime'];
        $unprivUser->prezime = $data['prezime'];
        $unprivUser->datumRodjenja = $data['rodjendan'];
        $unprivUser->opstinaPrebivalista_id = Mesto::where('naziv','=',$data['prebivaliste'])->first()->id;
        $unprivUser->adresaPrebivalista = $data['adresaPrebivalista'];
        $unprivUser->jmbg = $data['JMBG'];
        $unprivUser->pol = $data['pol'];
        $unprivUser->opstinaRodjenja_id = Mesto::where('naziv','=',$data['rodjenje'])->first()->id;
        $unprivUser->brojLicneKarte = $data['brojLicne'];
        $unprivUser->save();

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('userRegisterSuccess', 'Uspesna registracija!');
    }
}
