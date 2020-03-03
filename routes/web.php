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

Route::get('/home', function (){
    return view('homepages.obavestenja');})->name('home');

    Route::get('/ankete', function (){
        return view('homepages.aktivneAnkete');
    })->name('ankete');

    Route::get('/izbori', function (){
        return view('homepages.aktivneAnkete');
    })->name('izbori');

    Route::get('/referendumi', function (){
        return view('homepages.aktivneAnkete');
    })->name('referendumi');

Route::get('/mojeankete', function (){
    return view('homepages.mojeankete');
})->name('mojeankete');
Route::get('/statistikaankete', function (){
    return view('homepages.statistikaanketa');
})->name('statistikaankete');

Route::get('/mojeobjave', function (){
    return view('homepages.mojeobjave');
})->name('mojeobjave');

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/user/register', 'RegistrationController@getUserRegistrationForm')->name('user.register');
Route::get('/moderator/register', 'RegistrationController@getModeratorRegistrationForm')->name('moderator.register');
Route::get('/admin/moderators', function (){ return view('admin.moderatorApproval');});

Route::post('/user/register', 'RegistrationController@saveUser')->name('user.register.save');

