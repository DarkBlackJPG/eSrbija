<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

Route::get('/createpost', function (){
    return view('homepages.createpost');
})->name('createpost');

Route::get('/home', 'HomeController@glavnaStranica')->name('home');



    Route::get('/izbori', function (){
        return view('homepages.aktivneAnkete');
    })->name('izbori');

    Route::get('/referendumi', function (){
        return view('homepages.aktivneAnkete');
    })->name('referendumi');


    Route::get('/statistikaankete', function (){
    return view('homepages.statistikaanketa');
    })->name('statistikaankete');

     Route::get('/mojeobjave', function (){
    return view('homepages.mojeobjave');
    })->name('mojeobjave');


    Route::get('/objavesport', function (){
    return view('homepages.obavestenjasport');
    })->name('objavesport');
Route::get('/objavefinansije', function (){
    return view('homepages.obavestenjafinansije');
})->name('objavefinansije');
Route::get('/nemaobjava', function (){
    return view('homepages.nemaobjava');
})->name('nemaobjava');


Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login', 'Auth\LoginController@getForm')->name('login');

Route::post('login', 'Auth\LoginController@login')->name('loginPost');
Route::get('/user/register', 'RegistrationController@getUserRegistrationForm')->name('user.register');
Route::get('/moderator/register', 'RegistrationController@getModeratorRegistrationForm')->name('moderator.register');
Route::get('/admin/moderators', function (){ return view('admin.moderatorApproval');})->name('odobravanjemoderatora');


Route::post('/user/register', 'NeprivilegovanKorisnikRegistracija@register')->name('user.register.save');
Route::post('/moderator/register', 'ModeratorRegistracija@register')->name('moderator.register.save');
///////////////////////////////////////////
// CAREVIC
//Pazi na createPol a ne POLL


Route::get('/mojeankete','AnswerPollController@list_all_polls_created_by_me')->name('mojeankete');
Route::post('/mojeankete/{id}','AnswerPollController@close_poll')->name('zatvorianketu');
Route::post('/obrisianketu/{id}','CreatePolController@delete_poll')->name('obrisianketu');
Route::get('/ankete', 'AnswerPollController@list_active')->name('ankete');
Route::get('/ankete/{id}', 'AnswerPollController@answer_poll')->name('anketeid');
Route::post('/ankete/{id}', 'AnswerPollController@save_answers')->name('save_answers');
Route::get('/createpoll', 'CreatePolController@return_view')->name('createpoll');
Route::post('/savepoll', 'CreatePolController@create_poll')->name('savepoll');
////////////////////////////////////////////////////////////////////////////////////
