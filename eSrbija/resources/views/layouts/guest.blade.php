<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'eSrbija'}}</title>

    <!-- Scripts -->
    <!-- Izbrisao sam pozivanje app.js ovde jer nije radio logout -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
            crossorigin="anonymous"></script>
    <!-- include VueJS first -->
    <script src="https://unpkg.com/vue@latest"></script>

    <!-- use the latest vue-select release -->
    <script src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/662634c78e.js" crossorigin="anonymous"></script>

    {{--    Sweet alert JavaScript library--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mojeankete.css') }}" rel="stylesheet">
    <link href="{{ asset('css/statistikaankete.css') }}" rel="stylesheet">


</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            {{--                Created by Stefan Teslic--}}
            {{--                Napravljeno zbog funkcionalnog prototipa--}}
            {{--                Linije proveravaju na kojoj stranici se nalazimo --}}
            {{--                da daju iluziju dobrog route-ovanja--}}
            <a class="navbar-brand" href="{{ url('/') }}">

                eSrbija

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    {{--                @author Stefan Teslic--}}
                    {{--                Ovo parce ifova dinamicki menja header--}}
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('login') }}">{{ __('Logovanje') }}</a>
                        </li>
                        @if (Route::has('user.register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.register') }}">{{ __('Registracija korisnika') }}</a>
                            </li>
                        @endif
                        @if (Route::has('moderator.register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('moderator.register') }}">{{ __('Registracija moderatora') }}</a>

                            </li>
                        @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
