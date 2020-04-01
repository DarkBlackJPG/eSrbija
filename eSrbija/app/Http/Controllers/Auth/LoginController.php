<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Korisnik;
use App\Moderator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\App;
use MongoDB\Driver\Session;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ModeratorNotApprovedException extends \Exception {

}
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getForm(){
        return view('auth.login');
    }

    public function validateLogin(Request $request) {
        return $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[0-9]/i',
            ],
        ]);
    }

    public function attemptLogin(Request $request)
    {
        $user = Korisnik::where('email','=',$request->email)->first();
        if ($user != null && $user->isMod == true && $user->isAdmin == false){
            $moderator = $user->moderatori()->first();
            if($moderator->approved == false) {
                throw new ModeratorNotApprovedException();

            }
        }
        if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return true;
        }
        return false;
    }

    public function login(Request $request) {
        try {
            $this->validateLogin($request);

            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }


            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } catch (ModeratorNotApprovedException $e) {
            return redirect('/')->with('moderatorNotApproved', 'Vas zahtev jos nije obradjen!');
        }
    }
    public function guard()
    {
        return Auth::guard('korisnik');
    }

    public function logout(Request $request) {

        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');

    }

}
