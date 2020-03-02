<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md highlightText">
                    e<font class="blueTextHighlight">-Srbija</font>
                </div>

                <div class="links blueTextHighlight">
                    @if (Route::has('login'))
                        <a  class="linkTransitionToRed" href="{{ route('login') }}">Login</a>
                    @endif
                    @if  (Route::has('user.register'))
                        <a class="linkTransitionToRed" href="{{ route('user.register') }}">Registracija korisnika</a>
                    @endif
                    @if (Route::has('moderator.register'))
                        <a class="linkTransitionToRed" href="{{ route('moderator.register') }}">Registracija moderatora</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
