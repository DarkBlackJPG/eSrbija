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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/register', 'RegistrationController@getUserRegistrationForm')->name('user.register');
Route::get('/moderator/register', 'RegistrationController@getModeratorRegistrationForm')->name('moderator.register');
Route::get('/admin/moderators', function (){ return view('admin.moderatorApproval');});

Route::post('/user/register', 'RegistrationController@saveUser')->name('user.register.save');
