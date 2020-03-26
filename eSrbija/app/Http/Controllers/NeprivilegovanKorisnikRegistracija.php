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
        //$this->middleware('guest:korisnik');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:korisniks,e-mail'],
            'rodjendan' => ['required', 'date', 'email', 'max:255'],
            'prebivaliste' => ['required', 'string', 'max:255', 'exists:mestos,naziv'],
            'adresaPrebivalista' => ['required', 'string', 'max:255'],
            'JMBG' => ['required', 'string', 'max:13', 'unique:neprivilegovan_korisniks,jmbg'],
            'pol' => ['required', 'boolean'],
            'rodjenje' => ['required', 'string', 'exists:mestos,naziv'],
            'brojLicne' => ['required', 'string', 'email', 'max:9', 'unique:neprivilegovan_korisniks,brojLicneKarte'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function register(Request $request)
    {
        // Imam neki bag, nece da tadi TODO: Resiti ovaj bag ovde da validira kako treba
        $validate = $request->validate([
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:korisniks,e-mail'],
            'rodjendan' => ['required', 'date', 'max:255'],
            'prebivaliste' => ['required', 'string', 'max:255', 'exists:mestos,naziv'],
            'adresaPrebivalista' => ['required', 'string', 'max:255'],
            'JMBG' => ['required', 'string', 'max:13', 'unique:neprivilegovan_korisniks,jmbg'],
            'pol' => ['required', 'boolean'],
            'rodjenje' => ['required', 'string', 'exists:mestos,naziv'],
            'brojLicne' => ['required', 'string', 'max:9', 'unique:neprivilegovan_korisniks,brojLicneKarte'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        //dd('ds');

        $user = Korisnik::create([
            'e-mail' =>$request['email'],
            'password' => Hash::make($request['password']),
            // Type = 0 jer je default
        ]);
        $data = $request;

        NeprivilegovanKorisnik::create([
            'id' => $user->id,
            'ime' => $data['ime'],
            'prezime' => $data['prezime'],
            'datumRodjenja' => $data['rodjendan'],
            'opstinaPrebivalista_id' => Mesto::where('naziv','=',$data['prebivaliste'])->first()->id,
            'adresaPrebivalista' => $data['adresaPrebivalista'],
            'jmbg' => $data['JMBG'],
            'pol' => $data['pol'],
            'opstinaRodjenja_id' => Mesto::where('naziv','=',$data['rodjenje'])->first()->id,
            'brojLicneKarte' => $data['brojLicne'],
        ]);

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}