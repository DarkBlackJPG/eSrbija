<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function getUserRegistrationForm()
    {
        $allPlaces = \App\Mesto::all();
        return view('auth.registerUser', ['mesta' => $allPlaces]);
    }
    public function getModeratorRegistrationForm()
    {
        $allPlaces = \App\Mesto::all();
        $allCategories = \App\Kategorije::all();
        return view('auth.registerModerator', ['mesta' => $allPlaces, 'kategorije' => $allCategories]);
    }
    public function saveUser(){
        return request();
    }
}
