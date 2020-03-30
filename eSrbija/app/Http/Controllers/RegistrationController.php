<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct()
    {
       //
    }

    /**
     * Returns the registration form for unprivileged users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Stefan Teslic
     */
    public function getUserRegistrationForm()
    {
        $allPlaces = \App\Mesto::all();
        return view('auth.registerUser', ['mesta' => $allPlaces]);
    }

    /**
     * Returns the registration form for moderators.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Stefan Teslic
     */
    public function getModeratorRegistrationForm()
    {
        $allPlaces = \App\Mesto::all();
        $allCategories = \App\Kategorije::all();
        return view('auth.registerModerator', ['mesta' => $allPlaces, 'kategorije' => $allCategories]);
    }
}
