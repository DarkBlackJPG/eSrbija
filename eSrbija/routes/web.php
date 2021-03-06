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

/**
 * verify => true sets the email verification routes
 *
 * @author Stefan Teslic
 **/

Auth::routes(['verify' => true]);





Route::get('/objavesport', function (){
    return view('homepages.obavestenjasport');
})->name('objavesport');
Route::get('/objavefinansije', function (){
    return view('homepages.obavestenjafinansije');
})->name('objavefinansije');
Route::get('/nemaobjava', function (){
    return view('homepages.nemaobjava');
})->name('nemaobjava');



/**
 *  Group for routes that expect that the user is not logged in
 *
 *  @author Stefan Teslic
 *  @middleware Guest
 */
Route::middleware(['guest'])->group(function () {
    /**
     * Get login form route
     *
     * @author Stefan Teslic
     */
    Route::get('login',
        'Auth\LoginController@getForm')
        ->name('login');
    /**
     * POST login form details to this route
     *
     * @author Stefan Teslic
     */
    Route::post('login',
        'Auth\LoginController@login')
        ->name('loginPost');

    /**
     * Gets the registration form for User
     *
     * @author Stefan Teslic
     */
    Route::get('/user/register',
        'RegistrationController@getUserRegistrationForm')
        ->name('user.register');
    /**
     * Gets the registration form for Moderator
     *
     * @author Stefan Teslic
     */
    Route::get('/moderator/register',
        'RegistrationController@getModeratorRegistrationForm')
        ->name('moderator.register');

    /**
     * Sends user registration details to this route
     *
     * @author Stefan Teslic
     */
    Route::post('/user/register',
        'NeprivilegovanKorisnikRegistracija@register')
        ->name('user.register.save');
    /**
     * Sends moderator registration details to this route
     *
     * @author Stefan Teslic
     */
    Route::post('/moderator/register',
        'ModeratorRegistracija@register')
        ->name('moderator.register.save');


    /**
     * Gets the welcome page
     *
     * @author Stefan Teslic
     */
    Route::get('/', function () { return view('welcome'); });
     /**
     * Gets the mail resend form
     *
     * @author Stefan Teslic
     */
    Route::get('email/resend', 'NeprivilegovanKorisnikRegistracija@getResendForm')->name('verification.resend');
     /**
     * Posts the reset email form details
     *
     * @author Stefan Teslic
     */
    Route::post('email/resend', 'NeprivilegovanKorisnikRegistracija@resend')->name('verification.resend.post');
     /**
     * Verifies the user and token from sent mail <-- reset form for password
     *
     * @author Stefan Teslic
     */
    Route::get('/user/confirm_mail/{user}/{token}', 'NeprivilegovanKorisnikRegistracija@verify')->name('user.verify');
});

/**
 *  Group for routes that expect that the user is logged in
 *
 *  @author Stefan Teslic
 *  @middleware Verified, Auth
 */
Route::middleware(['verified', 'auth'])->group(function () {
    /**
     * Main page after authentication.
     * Has to be verified and authenticated
     *
     * @author Stefan Teslic
     */
    Route::get('/home',
        'HomeController@glavnaStranica')
        ->name('home');
    /**
     * Logout handler.
     * Has to be verified and authenticated
     *
     * @author Stefan Teslic
     */
    Route::get('/logout',
        'Auth\LoginController@logout')
        ->name('logout');

    /** @author Filip Carevic */

    Route::get('/ankete/{page?}', 'AnswerPollController@list_active')->name('ankete');
    Route::get('/ankete/popuni/{id}', 'AnswerPollController@answer_poll')->name('anketeid');
    Route::post('/ankete/popuni/{id}', 'AnswerPollController@save_answers')->name('save_answers');
    Route::get('/izbori/{page?}', 'AnswerPollController@list_active_elections' )->name('izbori');
    Route::get('/referendumi/{page?}', 'AnswerPollController@list_active_referendum')->name('referendumi');


    /** ********************************************* */

    /**
     * Ruta za prijavljivanje na kategoriju.
     *
     * @author Luka Spehar
     */
    Route::post('/home/subscribe', 'HomeController@subscribe')->name('subscribe');

    /**
     * Ruta za odjavljivanje sa kategorije.
     *
     * @author Luka Spehar
     */
    Route::post('/home/unsubscribe', 'HomeController@unsubscribe')->name('unsubscribe');

    /**
     * Ruta za pretragu obavestenja po naslovu.
     * 
     * @author Luka Spehar
     */
    Route::get('/search', 'HomeController@search')->name('search');

    /**
    * Ruta za prikaz obavestenja za kategoriju za dati id-ijem
    * @author Dušan Stijović
    */
    Route::get('/obavestenja/{id}', [
        "uses" => "ObavestenjaController@prikaziObavesenjaZaKategoriju",
         "as" => "obavestenja_za_kategoriju"
    ]);



    /**
     *  Group for routes that are specific to Moderators only
     *
     *  Possible that the project does't have 'moderator-specific' routes
     *php
     *  @author Stefan Teslic
     *  @middleware IsMod
     */
    Route::middleware(['isMod'])->group(function () {


        /**
         * Ruta za prikaz forme za kreiranje novog obavestenja.
         * @author Luka Spehar
         */
        Route::get('/createpost', 'ObavestenjaController@create')->name('createpost');
        /**
         * Ruta za snimanje novog obavestenja.
         * @author Luka Spehar
         */
        Route::post('/createpost', 'ObavestenjaController@store')->name('storepost');

        /** @author Filip Carevic */
        Route::get('/mojeankete/{page?}','AnswerPollController@list_all_polls_created_by_me')->name('mojeankete');
        Route::post('/mojeankete/zatvori/{id}','AnswerPollController@close_poll')->name('zatvorianketu');
        Route::post('/obrisianketu/{id}','CreatePolController@delete_poll')->name('obrisianketu');
        Route::get('/createpoll', 'CreatePolController@return_view')->name('createpoll');
        Route::post('/savepoll', 'CreatePolController@create_poll')->name('savepoll');
        /** ********************************************** */


        /**
        * Ruta za prikaz statistike za anketu za datim id-ijem
        * @author Dušan Stijović
        */
        Route::get('/statistikaankete/{id}', [
            "uses" => "AnketeController@statistikaAnkete",
            "as" => "statistikaankete"
            ]);



        /**
        * Ruta za prikaz obavestenja za korisnika koji je ulogovan u sistem
        * @author Dušan Stijović
        */
        Route::get('/mojaObavestenja', [
            "uses" => "ObavestenjaController@prikaziMojaObavestenja",
            "as" => "mojaObavestenja"
        ]);


         /**
        * Ruta za brisanje odgovarajuceg obavestenja
        * @author Dušan Stijović
        */
        Route::post('/obrisiObavestenje/{id}', [
            "uses" => "ObavestenjaController@obrisiObavestenje",
            "as" => "obrisiObavestenje"
        ]);



        /**
         *  Group for routes that are specific to Admins only
         *
         *  @author Stefan Teslic
         *  @middleware IsAdmin
         */
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/admin/moderators',
                'AdministratorController@getModeratorApprovalForms')
                ->name('odobravanjemoderatora');
            Route::post('/admin/moderators/{id}/approve',
                'AdministratorController@moderatorApprove')
                ->name('admin.moderatorApprove');
            Route::post('/admin/moderators/{id}/reject',
                'AdministratorController@moderatorReject')
                ->name('admin.moderatorReject');

            /**
             * Ajax request method for modderator approval
             *
             * @author Stefan Teslic
             */
            Route::get('/admin/moderator_request', 'AdministratorController@moderatorRequestCheck')->name('admin.ajax.moderatorRequestCheck');
        });

    });
});




