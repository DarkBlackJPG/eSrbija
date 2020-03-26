<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function getUserRegistrationForm()
    {
        return view('auth.registerUser');
    }
    public function getModeratorRegistrationForm()
    {
        return view('auth.registerModerator');
    }
    public function saveUser(){
        return request();
    }
}
