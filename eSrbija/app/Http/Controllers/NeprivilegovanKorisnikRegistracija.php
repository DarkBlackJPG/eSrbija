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


    protected $redirectTo = RouteServiceProvider::WELCOME;


    public function __construct()
    {
        $this->middleware('guest')->except(['verify','resend']);
    }

    /**
     *  This method registers the unprivileged user and sends him the verification link
     *  to the email that he entered.
     *
     *  Redirects to the welcome page for guests with a success alert.
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author Stefan Teslic
     */
    protected function register(Request $request)
    {

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
                'unique:korisniks,email'
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
                'size:13',
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
                'size:9',
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
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->isMod = false;
        $user->isAdmin = false;
        $user->verification_token = Hash::make((string)$user->email.(string)now());
        $user->verification_token = str_replace("/", "_", $user->verification_token);
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


        \Mail::to($user->email)->send(new \App\Mail\EmailVerification($user));

        return $this->registered($request, $user)
            ?: redirect('/')->with('userRegisterSuccess', 'Uspesna registracija!');
    }

    /**
     * Method verifies the user. This method is invoked
     * from the sent link to the users' mail address.
     *
     * The $request has a token and user element which is recieved
     * from the GET link request from the link provided
     * in the sent mail.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author Stefan Teslic
     */
    public function verify(Request $request) {
        $token = $request['token'];
        $user_id = $request['user'];

        $user = Korisnik::where('id', '=', $user_id)->first();

        if(!$user->verification_token == null && $user->verification_token == $token) {
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();
            if(auth()->user() != null)
                return redirect('/home')
                    ->with('tokenVerifiedSuccessfully', 'Uspesno ste potvrdili vasu email adresu!');
            else
                return redirect('/')
                    ->with('tokenVerifiedSuccessfully', 'Uspesno ste potvrdili vasu email adresu!');
        } else {
            if(auth()->user() != null)
                return redirect('/home')
                    ->with('tokenInvalid', 'Problem sa linkom');
            else
                return redirect('/')
                    ->with('tokenInvalid', 'Problem sa linkom');

        }


    }

    /**
     * Returns the resend form for email verification concerning the "NeprivilegovanKorisnik" users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Stefan Teslic
     */
    public function getResendForm() {
        return view('auth.verify');
    }

    /**
     * This function handles the requested mail resend for verification of users' email address
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author Stefan Teslic
     */
    public function resend() {
        $user = auth()->user();
        \Mail::to($user->email)->send(new \App\Mail\EmailVerification($user));
        return redirect()->back()->with('resent', 'Uspesno poslato!');
    }


}
